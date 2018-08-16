<?php

namespace Admin\Employee\Services;

use Admin\Employee\Models\EmployeeModel;

class EmployeeService
{
    private $employeeModel = null;
    
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function getList()
    {
        return $this->employeeModel->getList();
    }

    public function remove( $identify )
    {
        return $this->employeeModel->remove( $identify );
    }

    public function create( array $data )
    {
        return $this->employeeModel->create( $data );
    }

    public function update( $identify , array $data )
    {
        return $this->employeeModel->update( $identify , $data );
    }

    public function edit( $identify )
    {
        return $this->employeeModel->edit( $identify );
    }

    public function find( $identify )
    {
        return $this->employeeModel->find( $identify );
    }

    public function findByCode( $value )
    {
        return $this->findByCode( $value );
    }

}