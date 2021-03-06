<?php

namespace Tests\Feature\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanCreateUser(): void
    {
        $user = User::factory()->hasRoles(1, ['name' => 'Admin'])->create();

        $response = $this->actingAs($user)->get(route('admin.users.create'));

        $response->assertViewIs('admin.users.create');
        $response->assertStatus(200);
    }
}
