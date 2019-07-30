<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthenticatedTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group auth
     * @group authenticated
     */
    public function 認証済みでなければログイン後ページへのアクセスはログインページへリダイレクトされること()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->assertPathIs('/login');
        });
    }

    /**
     * @test
     * @group auth
     * @group authenticated
     */
    public function 認証済みであればログイン後ページへアクセスできること()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)->visit('/home')
                ->assertPathIs('/home');
        });
    }
}
