<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'gender' => 'required|max:1',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors(),
            ], 200);
        }

        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['gender'] = $request->gender;
        $userData['password'] = $request->password;

        if ($userData['gender'] != "M" && $userData['gender'] != "F") {
            return response([
                'status' => false,
                'message' => "Gender must be 'M' of 'F'",
            ], 200);
        }

        $user = new User();
        list($status, $message, $technicalMessage) = $user->register($userData);

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors(),
            ], 200);
        }

        $userData['email'] = $request->email;
        $userData['password'] = $request->password;

        $user = new User();
        list($status, $message, $technicalMessage, $data) = $user->login($userData);
        // $this->returnJson($status, $message, $technicalMessage, $data);
        return response([
            'status' => $status,
            'message' => $message,
            'technicalMessage' => $technicalMessage,
            'data' => $data
        ], 200);
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            $this->returnJsonErrorDataNotValid($validator->errors());
        }

        $token = $request->token;
        $user = new User();
        list($status, $message, $technicalMessage) = $user->logout($token);
        //$this->returnJson($status, $message, $technicalMessage, null);
        // return response()->json($status, $message, $technicalMessage, null);
        return response([
            'status' => $status,
            'message' => $message,
            'technicalMessage' => $technicalMessage,
        ], 200);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::all();
        return response()->json($data, 200);
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
