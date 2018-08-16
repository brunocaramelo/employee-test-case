<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

use Admin\Reports\Services\EmployeeReportService;

class EmployeeReportTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_general_report()
    {
        $expected =[   
                    'quantity_men' => '2',
                    'quantity_women' => '3',
                    'avarege_age' => '40.6',
                    'max_age' => '65',
                    'min_age' => '18',
                    ];
        $userService = new EmployeeReportService();
        
        $this->assertEquals( $userService->getReport() , $expected );
    }
    
    public function test_quantity_men()
    {
  
        $userService = new EmployeeReportService();
        
        $this->assertEquals( $userService->getQuantityMen() , 2 );
    }
    
    public function test_quantity_woman()
    {
  
        $userService = new EmployeeReportService();
        
        $this->assertEquals( $userService->getQuantityWoMan() , 3 );
    }
    
    public function test_avarege_age()
    {
  
        $userService = new EmployeeReportService();
        
        $this->assertEquals( $userService->getAvaregeAge() , 40.6 );
    }
    
    public function test_max_age()
    {
  
        $userService = new EmployeeReportService();
        
        $this->assertEquals( $userService->getMaxAge() , 65 );
    }
    
    public function test_min_age()
    {
  
        $userService = new EmployeeReportService();
        
        $this->assertEquals( $userService->getMinAge() , 18 );
    }

}