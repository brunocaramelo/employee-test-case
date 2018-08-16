<?php

namespace Admin\Employee\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeEntity extends Model
{
    protected $table = 'employee';
    
    protected $fillable = [
                            'name', 
                            'last_name', 
                            'age',
                            'genre',
                            'status',
                        ];
    

}
