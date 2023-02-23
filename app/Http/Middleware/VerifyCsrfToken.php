<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/students',
        '/students/academics',
        '/students/cgpa',
        '/students/cgpa/1',
        '/students/1',
        '/students/academics/1',
        '/students/family',
        '/students/family/1',
        '/courses',
        '/courses-marks',
        '/courses/avg/1'
    ];
}
