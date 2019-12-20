<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\StatusUserCourse;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subject;
use App\Http\Requests\CourseRequest;
use App\Models\User;
use DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest('id')
            ->with('category')
            ->paginate(config('configcourse.PagePaginate'));

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Get the sub categories.
     * 
     * @param int $parent_id
     * @return mix
     */
    private function getSubCategories($parent_id, $ignore_id = null)
    {
        $categories = Category::where('parent_id', $parent_id)
            ->where('id', '<>', $ignore_id)
            ->get()
            ->map(function($query) use ($ignore_id) {
                $query->sub = $this->getSubCategories($query->id, $ignore_id);

                return $query;
            });

        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $categories = $this->getSubCategories(config('configcourse.subcategories'));

        return view('admin.courses.create', compact('categories', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        if ($request->hasFile('image')) {  
            $image = $this->uploadImage($request);
        } else {
            $image = config('configcourse.image_default');
        }
        $attr = [
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
            'image' => $image,
        ];
        $course = Course::create($attr);
        $course_id = $course->id;
        $course = Course::find($course_id);
        $course->subjects()->attach($request->subject_id);
        
        return redirect()->route('admin.courses.index')->with('alert', trans('setting.add_course_success'));
    }

    public function uploadImage(CourseRequest $request)
    {
        $destinationDir = public_path(config('configcourse.public_path'));
        $fileName = uniqid('course') . '.' . $request->image->extension();
        $request->image->move($destinationDir, $fileName);
        $image = config('configcourse.image_course') . $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $course = Course::findOrFail($id);
            $listSubject = Course::find($id)->subjects()->orderBy('name')->get();
            $userCourse = Course::find($id)->users()->get();
            $listUser = User::all();
            $statusUser = DB::table('user_course')
                ->where('course_id', $id)
                ->get();

            return view('admin.courses.show', compact('course', 'listSubject', 'userCourse', 'listUser', 'statusUser'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function postShow(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $check = DB::table('user_course')
                ->where('course_id', $id)
                ->where('user_id', $request->user_id)
                ->get();
            $checkStatusUser = DB::table('user_course')
                ->where('user_id', $request->user_id)
                ->where('status', StatusUserCourse::Activity)
                ->get();
            if (count($checkStatusUser) >= config('configcourse.checkStatusUser')) {
                return redirect()->route('admin.courses.show', $course->id)->with('error', trans('setting.check_status_user'));
            } else {
                if (count($check) >= config('configcourse.check')) {
                    return redirect()->route('admin.courses.show', $course->id)->with('error', trans('setting.check_user_course'));
                } else {
                    Course::find($id)->users()->attach($request->user_id);

                    return redirect()->route('admin.courses.show', $course->id)->with('alert', trans('setting.assign_success'));
                }
            }    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function finishCourse(Request $request, $id)
    {
        DB::table('user_course')
            ->where('course_id', $id)
            ->where('user_id', $request->user_id)
            ->update(['status' => StatusUserCourse::Finished]);

        return redirect()->route('admin.courses.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            $categories = Category::all();
            $subject = Course::find($id)->subjects()->orderBy('name')->get();
            $subjects = Subject::all();

            return view('admin.courses.edit', compact('course', 'categories', 'subject', 'subjects'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        try {
            if ($request->hasFile('image')) {  
                $image = $this->uploadImage($request);
            } else {
                $image = $course->image;
            }
            $course = Course::findOrFail($id);
            $attr = [
                'category_id' => $request->get('category_id'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'status' => $request->get('status'),
                'image' => $image,
            ];
            $course->update($attr);
            $course->subjects()->detach();
            $course->subjects()->attach($request->subject_id);

            return redirect()->route('admin.courses.index')->with('alert', trans('setting.edit_course_success'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            return redirect()->route('admin.courses.index')->with('alert', trans('setting.delete_course_success'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
