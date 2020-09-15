<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        // dd($request->getHost());
        $host = $request->getHost();
        switch ($host) {
            case 'localhost':
                if (!$request->expectsJson()) {
                    return route('admin.login');
                }
                break;
            case 'student.localhost':
                if (!$request->expectsJson()) {
                    return route('student.login');
                }
                break;
            case 'teacher.localhost':
                if (!$request->expectsJson()) {
                    return route('teacher.login');
                }
                break;
        }
    }
}
