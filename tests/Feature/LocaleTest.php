<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocaleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->get('/locale/en')
            ->assertStatus(302);
    }

    public function testTranslation()
    {
        $this
            ->withSession(['locale' => 'pt-br'])
            ->get('/')
            ->assertSee('Tópicos recentes');
    }
}
