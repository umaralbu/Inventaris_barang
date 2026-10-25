<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_crud_uses_username_without_name_or_email_fields(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->assertFalse(Schema::hasColumn('users', 'email'));
        $this->assertFalse(Schema::hasColumn('users', 'email_verified_at'));

        $this->actingAs($admin)
            ->get(route('users.create'))
            ->assertOk()
            ->assertSee('name="username"', false)
            ->assertDontSee('name="name"', false)
            ->assertDontSee('name="email"', false);

        $this->post(route('users.store'), [
            'username' => 'pegawai_baru',
            'password' => 'password123',
            'role' => User::ROLE_USER,
        ])->assertRedirect(route('users.index'));

        $newUser = User::where('username', 'pegawai_baru')->firstOrFail();
        $this->assertSame('pegawai_baru', $newUser->name);

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSee('Username')
            ->assertDontSee('Email')
            ->assertDontSee('Nama');

        $this->put(route('users.update', $newUser), [
            'username' => 'pegawai_aktif',
            'role' => User::ROLE_USER,
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $newUser->id,
            'username' => 'pegawai_aktif',
            'name' => 'pegawai_baru',
        ]);
    }
}
