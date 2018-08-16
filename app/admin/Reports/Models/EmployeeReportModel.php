<?php

namespace Admin\Reports\Models;

use Illuminate\Support\Facades\Hash;

use Admin\Employee\Entities\EmployeeEntity;
use Admin\Reports\Repositories\EmployeeReportRepository;

class EmployeeReportModel
{
    private $empRepo = null;
    
    public function __construct()
    {
        $this->empRepo = new EmployeeReportRepository( new EmployeeEntity() );
    }

    public function getQuantityMen()
    {
        return $this->empRepo->getQuantityMen()->get();
    }

    public function getQuantityWoMan()
    {
        return $this->empRepo->getQuantityWoMan()->get();
    }
    
    public function getAvaregeAge()
    {
        return $this->empRepo->getAvaregeAge()->get();
    }
    
    public function getMaxAge()
    {
        return $this->empRepo->getMaxAge()->get();
    }
    
    public function getMinAge()
    {
        return $this->empRepo->getMinAge()->get();
    }
}