<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __invoke()
    {

        $persons = [
            [
                'id' => 1,
                'name' => 'John',
                'age' => 30
            ],
            [
                'id' => 2,
                'name' => 'Jim',
                'age' => 22
            ],
            [
                'id' => 3,
                'name' => 'Johnatan',
                'age' => 27
            ],
            [
                'id' => 4,
                'name' => 'JimBim',
                'age' => 17
            ],
            [
                'id' => 5,
                'name' => 'JimBimBo',
                'age' => 37
            ]
        ];

        return $persons;
    }


}
