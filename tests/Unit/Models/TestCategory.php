<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;

class TestCategory extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_categories_relation()
    {
        $category = new Category();
        $relation = $category->categories();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id', $relation->getLocalKeyName());
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
    }

    public function test_courses_relation()
    {
        $category = new Category();
        $relation = $category->courses();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id', $relation->getLocalKeyName());
        $this->assertEquals('category_id', $relation->getForeignKeyName());
    }

    public function test_contains_valid_properties()
    {
        $category = new Category();

        $this->assertEquals(['parent_id', 'name', 'description'], $category->getFillable());
    }
}
