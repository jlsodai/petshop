<?php

namespace Tests\Feature\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_table_exists()
    {
        $this->assertTrue(Schema::hasTable('users'));
    }

    public function test_columns_exist()
    {
        $this->assertTrue(Schema::hasColumns('users', ['id', 'uuid', 'first_name', 'last_name', 'is_admin', 'email', 'email_verified_at', 'password', 'avatar', 'address', 'phone_number', 'is_marketing', 'created_at', 'updated_at', 'last_login_at']));
    }
}
