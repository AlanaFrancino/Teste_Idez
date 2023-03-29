<?php

use Tests\TestCase;

class MunicipiosControllerIntegrationTest extends TestCase
{
    public function testMunicipiosPorUfRetornaListaDeMunicipiosUsandoApiDoIbge()
    {
        putenv('API_PROVIDER=IBGE');

        $response = $this->get('/municipios/RS');

        $response->assertStatus(200)
            ->assertJsonCount(497)
            ->assertJsonFragment(['name' => 'Porto Alegre', 'ibge_code' => '4314902'])
            ->assertJsonFragment(['name' => 'Canoas', 'ibge_code' => '4304606'])
            ->assertJsonFragment(['name' => 'Novo Hamburgo', 'ibge_code' => '4313408']);
    }
}
