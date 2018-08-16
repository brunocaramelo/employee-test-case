<?php

namespace Admin\Employee\Validators;
use Validator;

class EmployeeValidator{
    
    private $redirect = false;
    private $messages = false;
    
    public function __construct( $redirect = false )
    {
        $this->redirect = $redirect;
        $this->setMessages();
    }

    public function validateCreate( $fields )
    {
      return $this->make( $fields , [
                                        'last_name' => 'required',
                                        'name' => 'required',
                                        'age' => 'required',
                                    ]);
    }

    public function validateUpdate( $fields )
    {
       return $this->make( $fields , [
                                        'last_name' => 'required',
                                        'name' => 'required',
                                        'age' => 'required',
                                    ]);
    }

    public function make( $fields , $rules )
    {
        $validate =  Validator::make( $fields , $rules , $this->messages );
        if($this->redirect === true)
            return $validate->validate();
        return $validate;
    }

    private function setMessages()
    {
        $this->messages = [
                            'last_name.required'=>'Preencha o Sobre Nome',
                            'age.required'=>'Preencha a Idade',
                            'name.required'=>'Preencha o Nome',
                            ];
    }


}