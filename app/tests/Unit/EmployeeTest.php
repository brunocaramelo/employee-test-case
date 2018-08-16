<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

use Admin\Employee\Services\EmployeeService;

class EmployeeTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_list_prod_default()
    {
        $expected =  $this->return_list_seed_result();
                    
        $userService = new EmployeeService();
       
        $this->assertEquals( $userService->getList()->toArray() , $expected );
    }

    public function test_update_prod()
    {
        $expected = [      
                        'id' => '1',
                        'name' => 'Silvana',
                        'last_name' => 'Silva MUDEI',
                        'age' => '25',
                        'genre' => 'F',
                        'status' => 1
                    ];
        $params =  [  
                        'id' => '1',
                        'name' => 'Silvana',
                        'last_name' => 'Silva MUDEI',
                        'age' => '25',
                        'genre' => 'F',
                        'status' => 1
                    ];
        $userService = new EmployeeService();
        $userService->update( '1' , $params );
        $final = $userService->edit( 1 )->toArray();
        
        $this->assertEquals( $final , $expected );
    }
    
    /**
     * @expectedException         \Admin\Employee\Exceptions\EmployeeEditException
     * @expectedExceptionMessage Preencha o Nome
     */
    
    public function test_update_fail_email()
    {
        $params =[   'id' => '1',
                    'name' => null,
                    'last_name' => 'Silva MUDEI',
                    'age' => '25',
                    'genre' => 'F',
                    ];
        $userService = new EmployeeService();
        $userService->update( '1' , $params );
        $userService->edit( 1 )->toArray();
    }

    public function test_exclude_prod()
    {
        $expected =[   
                        'id' => '1',
                        'name' => 'Silvana',
                        'last_name' => 'Silva',
                        'age' => '25',
                        'genre' => 'F',
                        'status' => 0
                    ];

        $userService = new EmployeeService();
        $userService->remove( 1 );
        $final = $userService->edit( 1 )->toArray();
        
        $this->assertEquals( $final , $expected );
    }

    /**
     * @expectedException         \Admin\Employee\Exceptions\EmployeeEditException
     * @expectedExceptionMessage Preencha o Sobre Nome
     */
    public function test_fail_create_null_name_prod()
    {
        $expected = [  
                        'id' => '1',
                        'name' => 'Silvana',
                        'last_name' => null,
                        'age' => '25',
                        'genre' => 'F',
                    ];
        $userService = new EmployeeService();
        $userService->create( $expected );
        $userService->edit( 2 )->toArray();
    }

    public function test_create_prod()
    {
        $expected = [       
                        'name' => 'Antonio',
                        'last_name' => 'Last',
                        'age' => '50',
                        'genre' => 'M',
                        'status' => '1',
                    ];
        $prodService = new EmployeeService();
        $last = $prodService->create( $expected );
        $final = $prodService->edit( $last->id )->toArray();
        $expected['id'] = $last->id;
        $this->assertEquals( $final , $expected );
    }


    public function test_list_prod_filter_after_create()
    {
        $expected = $this->return_list_seed_result();

        $expected[] = [        
                        'id' => '6',
                        'name' => 'Antonio',
                        'last_name' => 'Last',
                        'age' => '50',
                        'genre' => 'M',
                    ];
        $this->test_create_prod();

        $userService = new EmployeeService();
        $this->assertEquals( $userService->getList()->toArray() , $expected );
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    private function return_list_seed_result()
    {
        return [
                [      
                    'id' => '1',
                            'name' => 'Silvana',
                            'last_name' => 'Silva',
                            'age' => '25',
                            'genre' => 'F',
                ],
                [        
                        'id' => '2',
                        'name' => 'Segunda',
                        'last_name' => 'Segunda',
                        'age' => '50',
                        'genre' => 'F',
                ],
                [        
                        'id' => '3',
                        'name' => 'Quarta',
                        'last_name' => 'Quarta',
                        'age' => '45',
                        'genre' => 'F',
            ],
            [        
                        'id' => '4',
                        'name' => 'Quinto',
                        'last_name' => 'Mais Velho',
                        'age' => '65',
                        'genre' => 'M',
            ],
            [        
                        'id' => '5',
                        'name' => 'Sexto',
                        'last_name' => 'Mais Novo',
                        'age' => '18',
                        'genre' => 'M',
            ],
        ];
        
    }
}
