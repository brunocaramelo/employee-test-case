<?php 

namespace Admin\Employee\Repositories;

use Admin\Employee\Entities\EmployeeEntity;

class EmployeeRepository
{
    private $car = null;

    public function __construct( EmployeeEntity $employee )
    {
        $this->employee = $employee;
    }

    public function getList()
    {
        $query = $this->employee->select(
                                'us.id as id',
                                'us.name as name',
                                'us.last_name as last_name',
                                'us.genre as genre',
                                'us.age as age'
                                )
                            ->from('employee AS us')
                            ->where( 'us.status' , '=' , '1' );
        return $query;
    }

    public function find( $identify )
    {
        return $this->employee->find( $identify );
    }

    public function findBy( $field , $value )
    {
        return $this->employee->where( $field , $value );
    }
    
    public function remove( $identify )
    {
        $employeeSave = $this->employee->find( $identify );
        return $employeeSave->fill( [ 'status' => '0' ] )->save();
        
    }
    
    public function create( $data )
    {
        return $this->employee->create( $data );
    }

    public function update( $identify , $data )
    {
        $employeeSave = $this->employee->find( $identify );
        return $employeeSave->fill( $data )->save();
    }

}