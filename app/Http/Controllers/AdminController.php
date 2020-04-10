<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     * Only admin can see all users
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        $this->message = 'list of all users';
        $this->data = $users;
        return $this->apiResponse();
    }
}
