<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function test_login_fail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(config('configtest.local_login'))
                ->type('email', 'adminn@mail.com')
                ->type('password', '12345678')
                ->press('Login')
                ->assertPathIs(config('configtest.login'));
        });
    }

    public function test_login_success()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(config('configtest.local_login'))
                ->type('email', 'admin@mail.com')
                ->type('password', '12345678')
                ->press('Login')
                ->assertPathIs(config('configtest.admin'));
        });
    }
}
