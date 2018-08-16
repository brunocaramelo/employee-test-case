<?php

namespace Admin\Employee\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeEntity extends Model
{
    // id, nome, sobrenome, idade e sexo.
    protected $table = 'employee';
    
    protected $fillable = [
                            'name', 
                            'last_name', 
                            'age',
                            'genre',
                            'status',
                        ];
    

}
