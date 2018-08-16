<?php
namespace Tests\Feature;
/*
 'name', 
'last_name', 
'age',
'genre',
'status',*/
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

use Admin\Employee\Services\EmployeeService;

class ProductTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_list_prod_default()
    {
        $expected = [  [  
                            'id' => '1',
                            'name' => 'Silvana',
                            'last_name' => 'Silva',
                            'age' => '25',
                            'genre' => 'F',
                        ]
                    ];
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
                    ];
        $params =  [  
                        'id' => '1',
                        'name' => 'Silvana',
                        'last_name' => 'Silva MUDEI',
                        'age' => '25',
                        'genre' => 'F',
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
                        'last_name' => 'Silva MUDEI',
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
                        'id' => '2',
                        'name' => 'Antonio',
                        'last_name' => 'Segundo',
                        'age' => '40',
                        'genre' => 'M',
                    ];
        $prodService = new EmployeeService();
        $prodService->create( $expected );
        $final = $prodService->edit( 2 )->toArray();
        $expected['id'] = 2;
        $this->assertEquals( $final , $expected );
    }


    public function test_list_prod_filter_after_create()
    {
        $expected = [
                        '0' => [      'id' => '1',
                                        'name' => 'Silvana',
                                        'last_name' => 'Silva',
                                        'age' => '25',
                                        'genre' => 'F',
                                ],
                        '1' => [        
                                    'id' => '2',
                                    'name' => 'Antonio',
                                    'last_name' => 'Segundo',
                                    'age' => '40',
                                    'genre' => 'M',
                                ]
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
}
