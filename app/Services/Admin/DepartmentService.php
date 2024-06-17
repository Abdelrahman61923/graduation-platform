<?php

namespace App\Services\Admin;


class DepartmentService
{
    public function checkRequestType($request)
    {
        return $request->expectsJson() ? 'api' : 'web';
    }


}
