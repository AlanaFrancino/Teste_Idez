<?php

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MunicipiosControllerTest extends TestCase
{
    public function testMunicipiosPorUfRetornaListaDeMunicipios()
    {
        $mockedResponse = [
            ['nome' => 'Porto Alegre', 'ibge' => '4314902'],
            ['nome' => 'Canoas', 'ibge' => '4304606'],
            ['nome' => 'Novo Hamburgo', 'ibge' => '4313408'],
        ];

        Http::fake([
            '*/api/ibge/municipios/v1/RS' => Http::response($mockedResponse, 200),
        ]);

        $response = $this->get('/municipios/RS');

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonFragment(['name' => 'Porto Alegre', 'ibge_code' => '4314902'])
            ->assertJsonFragment(['name' => 'Canoas', 'ibge_code' => '4304606'])
            ->assertJsonFragment(['name' => 'Novo Hamburgo', 'ibge_code' => '4313408']);
    }
}
