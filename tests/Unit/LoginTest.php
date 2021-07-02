<?php

namespace Tests\Unit;

use App\Models\User;
use Carbon\Factory;
use Mockery;
use Tests\TestCase;

class LoginTest extends TestCase {

    /**
     * The status asserted was 302 because it indicates a re-direction
     * which in this case is the login form as login is required for a user to make todos
     *
     * @test
     */
     public function test_making_get_request_to_slash_home_with_no_authentication_fails_and_redirects() {
        $response = $this->get('http://127.0.0.1:8000/home');
        $response->assertStatus(302);
    }

    /**
     * Making sure that the former 302 response from the prev test redirects to the login
     * page and not any other random page
     *
     * @test
     */
    public function test_making_sure_that_get_requests_redirects_to_login_if_user_is_not_authenticated(){
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    /**
     *
     * @test
     */
    public function test_authenticated_user_can_log_in_and_gets_redirected_to_slash_home(){

        $user = User::factory()->create();

        $response = $this->post('/login',[
            'email' => $user->email,
            'password' =>'password'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('/home');
    }
}
