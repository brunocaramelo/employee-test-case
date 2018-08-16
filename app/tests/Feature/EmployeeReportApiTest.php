<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Artisan as Artisan;


class EmployeeReportApiTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

   
    public function test_general_reports()
    {   
        $this->get('/api/v1/reports/employees/',[ ] )
                ->assertStatus(200)
                ->assertJson([
                                "quantity_men" => "2",
                                "quantity_women" => "3",
                                "avarege_age" => "40.6000",
                                "max_age" => "65",
                                "min_age" => "18",
                             ]);
    }
   
    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
