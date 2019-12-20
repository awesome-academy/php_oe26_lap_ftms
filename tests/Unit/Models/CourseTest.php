<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Course;

class CourseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_category_relation()
    {
        $course = new Course();
        $relation = $course->category();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('category_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_subject_relation()
    {
        $course = new Course();
        $relation = $course->subjects();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('course_subject.course_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('course_subject.subject_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_user_relation()
    {
        $course = new Course();
        $relation = $course->users();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('user_course.course_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_course.user_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
