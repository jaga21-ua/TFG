<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_main_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_loads_medicamentos_index()
    {
        $response = $this->get(route('medicamentos.index'));
        $response->assertStatus(200);
    }

    /** @test */
    
    /** @test */
    public function it_loads_medicamento_index_with_pagination()
    {
        $response = $this->get(route('medicamentos.index', ['page' => 2]));
        $response->assertStatus(200);
    }

    /** @test */
    public function it_loads_medicamento_search_results()
    {
        $response = $this->get(route('medicamentos.index', ['search' => 'keyword']));
        $response->assertStatus(200);
    }

    

}
