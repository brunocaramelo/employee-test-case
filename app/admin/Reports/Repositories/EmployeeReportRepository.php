<?php

namespace Admin\Reports\Repositories;

use Admin\Employee\Entities\EmployeeEntity;

class EmployeeReportRepository
{
    private $employee = null;

    public function __construct( EmployeeEntity $employee )
    {
        $this->employee = $employee;
    }

    public function getQuantityMen()
    {
        return $this->employee->select(
                                         \DB::raw( 'count( us.id ) as count' )
                                        )
                            ->from('employee AS us')
                            ->where( 'us.genre' , '=' , 'M' );
    }

    public function getQuantityWoMan()
    {
        return $this->employee->select(
                                         \DB::raw( 'count( us.id ) as count' )
                                        )
                            ->from('employee AS us')
                            ->where( 'us.genre' , '=' , 'F' );
    }
    
    public function getAvaregeAge()
    {
        return $this->employee->select(
                                         \DB::raw( 'avg( us.age ) as count' )
                                        )
                            ->from('employee AS us');
    }
    
    public function getMaxAge()
    {
        return $this->employee->select(
                                         \DB::raw( 'max( us.age ) as count' )
                                        )
                            ->from('employee AS us');
    }
    
    public function getMinAge()
    {
        return $this->employee->select(
                                         \DB::raw( 'min( us.age ) as count' )
                                        )
                            ->from('employee AS us');
    }

}