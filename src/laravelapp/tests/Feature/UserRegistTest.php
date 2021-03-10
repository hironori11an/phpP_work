<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistTest extends TestCase
{
    /**
     * @test
     */
    // passwordKknnについては、クライアントチェックを行っているため省略
    use RefreshDatabase;
    public function regist()
    {
        //正常系 ４桁
        $res=$this->post(
            '/userRegist/success',
            [
            'name' => 'test',
            'password' => 'test',
            ]
        );
        $res->assertStatus(200);
        $this->assertDatabaseHas('users', ['name' => 'test']);

        //正常系　８桁記号混じり
        $res=$this->post(
            '/userRegist/success',
            [
                'name' => '123456-_',
                'password' => '123456-_',
            ]
        );
        $res->assertStatus(200);
        $this->assertDatabaseHas('users', ['name' => '123456-_']);

        //異常系 同一ユーザの登録
        $res=$this->post(
            '/userRegist/success',
            [
                'name' => 'test',
                'password' => 'test2',
            ]
        );
        $res->assertStatus(302);
        $res->assertRedirect('/userRegist');
        $res->assertSessionHas(
            'err_m',
            'test は既に登録されています<br>'
        );
    }

    /**
     * @test
     * @dataProvider additionProvider
     */
    
    public function testErrValidation($name, $password, $expected)
    {
        $res=$this->post(
            '/userRegist/success',
            [
            'name' => $name,
            'password' => $password,
            ]
        );
        $res->assertSessionHasErrors($expected);
    }

    public function additionProvider()
    {
        return [
            ['', '', ['name','password']],
            ['1111', '123', ['password']],
            ['123', '1111', ['name']],
            ['1111', '123456789', ['password']],
            ['123456789', '1111', ['name']],
            ['1111', 'ああああ', ['password']],
            ['ああああ', '1111', ['name']],
            ['ああああ', 'ああああ', ['name','password']],
        ];
    }
}
