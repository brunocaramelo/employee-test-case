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
        Employee::firstOrCreate([
            'id' => '2',
            'name' => 'Segunda',
            'last_name' => 'Segunda',
            'age' => '50',
            'genre' => 'F',
        ]);
        Employee::firstOrCreate([
            'id' => '3',
            'name' => 'Quarta',
            'last_name' => 'Quarta',
            'age' => '45',
            'genre' => 'F',
        ]);
        Employee::firstOrCreate([
            'id' => '4',
            'name' => 'Quinto',
            'last_name' => 'Mais Velho',
            'age' => '65',
            'genre' => 'M',
        ]);
        Employee::firstOrCreate([
            'id' => '5',
            'name' => 'Sexto',
            'last_name' => 'Mais Novo',
            'age' => '18',
            'genre' => 'M',
        ]);
    }
}
