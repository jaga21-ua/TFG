<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_guests_from_protected_routes()
    {
        $response = $this->get(route('chat.index'));
        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_allows_authenticated_users_to_access_protected_routes()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'), 
            'dni' => '12345678X',
            'apellidos' => 'Test Apellidos',
            'telefono' => '123456789',
            'ciudad' => 'Test Ciudad',
            'codigoPostal' => '12345',
            'provincia' => 'Test Provincia',
            'comunidad' => 'Test Comunidad',
            'edad' => 30,
            'sexo' => 'M',
            'esAdmin' => false,
        ]);

        $response = $this->actingAs($user)->get(route('chat.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function it_allows_admin_to_access_admin_routes()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'adminuser@example.com',
            'password' => bcrypt('password'),
            'dni' => '87654321X',
            'apellidos' => 'Admin Apellidos',
            'telefono' => '987654321',
            'ciudad' => 'Admin Ciudad',
            'codigoPostal' => '54321',
            'provincia' => 'Admin Provincia',
            'comunidad' => 'Admin Comunidad',
            'edad' => 35,
            'sexo' => 'F',
            'esAdmin' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('adminMenu'));
        $response->assertStatus(200);
    }

    /** @test */
    public function it_denies_non_admin_users_from_accessing_admin_routes()
    {
        $user = User::create([
            'name' => 'Non-Admin User',
            'email' => 'nonadminuser@example.com',
            'password' => bcrypt('password'),
            'dni' => '11223344X',
            'apellidos' => 'Non-Admin Apellidos',
            'telefono' => '112233445',
            'ciudad' => 'Non-Admin Ciudad',
            'codigoPostal' => '11223',
            'provincia' => 'Non-Admin Provincia',
            'comunidad' => 'Non-Admin Comunidad',
            'edad' => 25,
            'sexo' => 'M',
            'esAdmin' => false,
        ]);

        $response = $this->actingAs($user)->get(route('adminMenu'));
        $response->assertRedirect('/login');
    }
}
