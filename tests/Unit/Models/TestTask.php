<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Task;

class TestModel extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_subject_relation()
    {
        $task = new Task;
        $relation = $task->subject();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('id', $relation->getOwnerKeyName());
        $this->assertEquals('subject_id', $relation->getForeignKeyName());
    }

    public function test_user_relation()
    {
        $task = new Task;
        $relation = $task->users();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('user_task.user_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_task.task_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_contains_valid_properties()
    {
        $task = new Task();

        $this->assertEquals(['subject_id', 'name', 'description'], $task->getFillable());
    }
}
