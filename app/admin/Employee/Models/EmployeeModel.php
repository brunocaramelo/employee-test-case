<?php

namespace Admin\Employee\Models;

use Illuminate\Support\Facades\Hash;

use Admin\Employee\Validators\EmployeeValidator;
use Admin\Employee\Exceptions\EmployeeEditException;
use Admin\Employee\Entities\EmployeeEntity;
use Admin\Employee\Repositories\EmployeeRepository;
use Admin\Employee\Repositories\EmployeeCacheRepository; 

class EmployeeModel
{
    private $empRepo = null;
    
    public function __construct()
    {
        $this->empRepo = new EmployeeRepository( new EmployeeEntity() );
    }

    public function getList()
    {
        $userCache = new EmployeeCacheRepository( $this->empRepo );
        return $userCache->getList();
    }

    public function remove( $identify )
    {
        return $this->empRepo->remove( $identify );
    }

    public function create( array $data )
    {
        $validate = new EmployeeValidator();
        $validation = $validate->validateCreate( $data );
        if( $validation->fails() )
            throw new EmployeeEditException( implode( "\n" , $validation->errors()->all() ) );
        return $this->empRepo->create( $data );
    }

    public function update( $identify , array $data )
    {
        $validate = new EmployeeValidator();
        $validation = $validate->validateUpdate( $data );
        if( $validation->fails() )
            throw new EmployeeEditException( implode( "\n" , $validation->errors()->all() ) );
        return $this->empRepo->update( $identify , $data );
    }

    public function edit( $identify )
    {
        $edit = $this->find( $identify );
        unset( $edit['created_at'], $edit['updated_at'] , $edit['api_token'] );
        return $edit;
    }

    public function find( $identify )
    {
        $userCache = new EmployeeCacheRepository( $this->empRepo );
        return $userCache->find( $identify );
    }

    public function findByCode( $value )
    {
        return $this->findBy( 'code' , $value );
    }

    public function findBy( $field , $value )
    {
        return $this->empRepo->findBy( $field , $value )->first();
    }

}