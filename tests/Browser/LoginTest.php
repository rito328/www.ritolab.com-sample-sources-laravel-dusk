<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group auth
     * @group login
     */
    public function ログインが成功すること()
    {
        $password = 'Password@1234';

        $user = factory(User::class)->create([
            'email' => 'sample@example.com',
            'password' => Hash::make($password),
            'remember_token' => null
        ]);

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit('/login')
                ->type('#email', $user->email)
                ->type('#password', $password)
                ->press('Login')
                ->assertPathIs('/home');
        });
    }
}
