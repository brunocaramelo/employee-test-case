<?php

namespace Admin\Reports\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Admin\Reports\Services\EmployeeReportService;

class EmployeeReportController extends Controller
{
    public function __construct()
    {
    }
  
    public function getReport()
    {
        $service = new EmployeeReportService();
        return response()->json( $service->getReport() );
    }
}