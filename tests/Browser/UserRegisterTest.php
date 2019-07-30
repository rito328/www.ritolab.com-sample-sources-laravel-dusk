<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group auth
     * @group register
     */
    public function ユーザー登録が成功すること()
    {
        $user = factory(User::class, 'dusk_register_1')->make();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                ->type('#name', $user->name)
                ->type('#email', $user->email)
                ->type('#password', $user->password)
                ->type('#password-confirm', $user->password)
                ->press('Register')
                ->assertPathIs('/home');
        });
    }
}
