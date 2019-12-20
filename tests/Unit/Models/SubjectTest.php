<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;
use App\Models\Subject;

class SubjectTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_course_relation()
    {
        $subject = new Subject();
        $relation = $subject->courses();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('course_subject.subject_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('course_subject.course_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_task_relation()
    {
        $subject = new Subject();
        $relation = $subject->tasks();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('subject_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_user_relation()
    {
        $subject = new Subject();
        $relation = $subject->users();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('user_subject.subject_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_subject.user_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
