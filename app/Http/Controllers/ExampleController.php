<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiResponse\ApiResponse;

class ExampleController extends Controller
{
    use ApiResponse;

    /**
     * Get list User
     *
     * @return void
     */
    public function index()
    {
        return $this->successResponse("", ["1", "2"]);
    }
}
