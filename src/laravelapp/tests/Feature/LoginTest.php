<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function login()
    {
        //一般ホーム
        $res=$this->post(
            '/login/home',
            [
                'name' => 'ippan',
                'password' => 'ippan',
            ]
        );
        $res->assertLocation('/home');

        //管理ホーム
        $res=$this->post(
            '/login/home',
            [
                'name' => 'kanri',
                'password' => 'kanri',
            ]
        );
        $res->assertLocation('/kanri');

        //一般ホーム
        $res=$this->post(
            '/login/home',
            [
                'name' => 'test',
                'password' => 'test',
            ]
        );
        $res->assertLocation('/');
    }
}
