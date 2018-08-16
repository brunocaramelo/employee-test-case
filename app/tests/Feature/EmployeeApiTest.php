<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Artisan as Artisan;


class usersApiTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_fail_update_item()
    {   
        $this->put('/api/v1/user/1',[     
                                            "name" => null,
                                            "last_name" => "Sobre nome",
                                            "age" => 14,
                                    ])
                ->assertStatus(400)
                ->assertJson([
                                'message' => "Preencha o Nome" 
                            ]);
    }

    public function test_fail_create_item()
    {   
        $this->put('/api/v1/user/1',[     
                                            "name" => 'mudando nome',
                                            "last_name" => null,
                                            "age" => 10,
                                    ])
                ->assertStatus(400)
                ->assertJson([
                                'message' => "Preencha o Sobre Nome" 
                            ]);
    }
    
    public function test_update_item()
    {   
        $this->put('/api/v1/user/1',[     
                                        'name' => 'Silvana',
                                        'last_name' => 'Silva',
                                        'age' => '25',
                                        'genre' => 'F',
                                        ])
                ->assertStatus(200)
                ->assertJson([
                                'message' => 'Funcionario editado com sucesso' 
                            ]);
    }
    public function test_create_item()
    {   
        $this->post('/api/v1/user/',[     
                                    'name' => 'Segunda',
                                    'last_name' => 'Marques',
                                    'age' => '25',
                                    'genre' => 'F',
                                   ])
                ->assertStatus(200)
                ->assertJson([
                                'message' => 'Funcionario criado com sucesso' 
                            ]);
    }

    public function test_remove_item()
    {   
        $this->delete('/api/v1/user/1',[     
                                                "id" => "1",
                                        ])
                ->assertStatus(200)
                ->assertJson([
                                'message' => 'Funcionario excluido com sucesso' 
                            ]);
    }

    public function test_edit_item()
    {   
        $this->get('/api/v1/user/1',[     
                                                "id" => "1",
                                            ])
                ->assertStatus(200)
                ->assertJson([
                                "name" => "Silvana",
                                "last_name" => "Silva",
                             ]);
    }
    public function test_list_two_items()
    {   
        $this->test_create_item();

        $this->get('/api/v1/users/',[])
                ->assertStatus(200)
                ->assertSeeText('Silvana')
                ->assertSeeText('Segunda')
                ->assertSeeText('Silva')
                ->assertSeeText('Marques');
               
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
