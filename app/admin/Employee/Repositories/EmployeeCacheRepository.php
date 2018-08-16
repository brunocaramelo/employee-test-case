<?php

namespace Admin\Employee\Repositories;

use Illuminate\Support\Facades\Cache;


class EmployeeCacheRepository 
{
    protected $employees;

    public function __construct( EmployeeRepository $employees )
    {
        $this->employees = $employees;
    }

    public function getList()
    {
        return Cache::remember( 'employee.list' , $minutes = 10 , function () {
            return $this->employees->getList()->get();
        });
    }

  
    public function find( $id )
    {
        return Cache::remember("employees.{$id}", $minutes = 60, function () use ( $id ) {
            return $this->employees->find( $id );
        });
    }
}