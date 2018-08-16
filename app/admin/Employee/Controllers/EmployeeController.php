<?php

namespace Admin\Employee\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Admin\Employee\Services\EmployeeService;
use Admin\Employee\Exceptions\EmployeeEditException;

class EmployeeController extends Controller
{
    public function __construct()
    {
    }
  
    public function listAll()
    {
        $service = new EmployeeService();
        return response()->json( $service->getList() );
    }
    
    public function findById( Request $request )
    {
        $service = new EmployeeService();
        return response()->json( $service->edit( $request->id ) );
    }

    public function update( Request $request )
    {
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{        
            \DB::beginTransaction();
            $service = new EmployeeService();
            $service->update( $request->id , $request->all() );
            \DB::commit();
            $return['message'] = 'Funcionario editado com sucesso';
            return response()->json( $return );
        }catch( EmployeeEditException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }
    
    public function remove( Request $request )
    {
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{        
            \DB::beginTransaction();
            $service = new EmployeeService();
            $service->remove( $request->id );
            \DB::commit();
            $return['message'] = 'Funcionario excluido com sucesso';
            return response()->json( $return );
        }catch( EmployeeEditException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }

    public function create( Request $request )
    {
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{        
            \DB::beginTransaction();
            $service = new EmployeeService();
            $service->create( $request->all() );
            $return['message'] = 'Funcionario criado com sucesso';
            \DB::commit();
            return response()->json( $return );
        }catch( EmployeeEditException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = $error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }
}
