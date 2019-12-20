<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_activity_relation()
    {
        $user = new User();
        $relation = $user->activities();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function test_role_relation()
    {
        $user = new User();
        $relation = $user->role();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_course_relation()
    {
        $user = new User();
        $relation = $user->courses();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('user_course.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_course.course_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_subject_relation()
    {
        $user = new User();
        $relation = $user->subjects();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('user_subject.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_subject.subject_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_task_relation()
    {
        $user = new User();
        $relation = $user->tasks();
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('user_task.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_task.task_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
