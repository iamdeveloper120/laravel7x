<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use http\Env\Response;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    use ResponseTrait;


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request) {
        $email = $request->input('email') ?? null;
        $password = $request->input('password') ?? null;

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $this->errors[] = $validator->errors()->all();
            return $this->apiResponse();
        }
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $data['token'] =  $user->createToken($user->name)-> accessToken;
            $this->message = "User {$user->name} logged in successfully";
            $this->data = $data;
        }
        else{
            $this->status = 401;
            $this->message = 'Unauthorised';
        }
        return $this->apiResponse();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role' => 'in:admin,user'
        ]);
        if ($validator->fails()) {
            $this->status = 401;
            $this->errors[] = $validator->errors()->all();
            return $this->apiResponse();
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['token'] =  $user->createToken($user->name)-> accessToken;
        $data['name'] =  $user->name;
        $this->data = $data;
        return $this->apiResponse();
    }

    public function detail() {
        $user = Auth::user();
        $this->data = $user;
        return $this->apiResponse();
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        $this->message = 'list of all users';
        $this->data = $users;
        return $this->apiResponse();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        $this->message = 'Specific user record';
        $this->data = $user;
        return $this->apiResponse();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
