<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group auth
     * @group logout
     */
    public function ログアウトが成功すること()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)->visit('/home')
                ->click('#navbarDropdown')
                ->assertSee('Logout')
                ->clickLink('Logout')
                ->assertPathIs('/');
        });
    }
}
