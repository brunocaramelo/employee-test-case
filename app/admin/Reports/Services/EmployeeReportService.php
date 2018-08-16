<?php

namespace Admin\Reports\Services;

use Admin\Reports\Models\EmployeeReportModel;

class EmployeeReportService
{
    private $employeeModel = null;
    
    public function __construct()
    {
        $this->employeeModel = new EmployeeReportModel();
    }

    public function getReport()
    {
        return [
                    'quantity_men' => $this->getQuantityMen(),
                    'quantity_women' => $this->getQuantityWoMan(),
                    'avarege_age' => $this->getAvaregeAge(),
                    'max_age' => $this->getMaxAge(),
                    'min_age' => $this->getMinAge(),
               ];
    }
    
    public function getQuantityMen()
    {
        return $this->employeeModel->getQuantityMen()->toArray()[0]['count'];
    }

    public function getQuantityWoMan()
    {
        return $this->employeeModel->getQuantityWoMan()->toArray()[0]['count'];
    }
    
    public function getAvaregeAge()
    {
        return $this->employeeModel->getAvaregeAge()->toArray()[0]['count'];
    }
    
    public function getMaxAge()
    {
        return $this->employeeModel->getMaxAge()->toArray()[0]['count'];
    }
    
    public function getMinAge()
    {
        return $this->employeeModel->getMinAge()->toArray()[0]['count'];
    }

}