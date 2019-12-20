<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CourseIndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_course()
    {
        $this->browse(function (Browser $browse) {
            $browse->visit('http://127.0.0.1:8000/courses')
                ->type('email', 'kientmc0112@gmail.com')
                ->type('password', '12345678')
                ->click('#login')
                ->waitFor('#course1')
                ->click('#course1')
                ->assertUrlIs('http://127.0.0.1:8000/courses/1/show');
        });
    }
}
