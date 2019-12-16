<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Activity;

class TestActivity extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_user_relation()
    {
        $activity = new Activity;
        $relation = $activity->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('id', $relation->getOwnerKeyName());
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function test_contains_valid_properties()
    {
        $activity = new Activity;

        $this->assertEquals(['user_id', 'content', 'date', 'type'], $activity->getFillable());
    }
}
