<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;

class TestPermission extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_roles_relation()
    {
        $permission = new Permission;
        $relation = $permission->roles();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('role_permission.permission_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('role_permission.role_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_contains_valid_properties()
    {
        $permission = new Permission();

        $this->assertEquals(['name', 'slug'], $permission->getFillable());
    }
}
