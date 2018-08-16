<?php

use Illuminate\Database\Seeder;

use Admin\Employee\Entities\EmployeeEntity as Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::firstOrCreate([
            'id' => '1',
            'name' => 'Silvana',
            'last_name' => 'Silva',
            'age' => '25',
            'genre' => 'F',
        ]);
    }
}
