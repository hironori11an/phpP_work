<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function regist()
    {
        $data = [
            'user_id' => 'test',
            'password' => 'test',
            'passwordKknn' => 'password'
        ];
        $res=$this->post(
            '/userRegist/success',
            [
            'name' => 'test',
            'password' => 'test',
            'passwordKknn' => 'test'
        ]
        );
        $res->assertStatus(200);
        $this->assertDatabaseHas('users', ['name' => 'test']);
    }
}
