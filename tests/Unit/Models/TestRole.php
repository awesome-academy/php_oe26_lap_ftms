<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestRole extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_permission_relation()
    {
        $role = new Role;
        $relation = $role->permissions();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('role_permission.role_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('role_permission.permission_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_user_relation()
    {
        $role = new Role();
        $relation = $role->user();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id', $relation->getLocalKeyName());
        $this->assertEquals('role_id', $relation->getForeignKeyName());
    }
}
