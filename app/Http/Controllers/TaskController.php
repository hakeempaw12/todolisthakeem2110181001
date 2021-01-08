<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function get_user_task($email) {
        $task = Task::where('owner', $email)->get();
        return response([
            'status' => true,
            'message' => 'User Tasks',
            'technicalMessage' => '',
            'datas' => $task,
        ], 200);
    }

    public function get_shared_task(Request $request) {
        $task = Task::where('is_shared', '1')->where('owner', '<>', $request->email)->get();
        return response([
            'status' => true,
            'message' => 'Shared Tasks',
            'technicalMessage' => '',
            'datas' => $task
        ], 200);
    }

    public function set_shared_task($id) {
        $task = Task::find($id);

        $task->is_shared = 1;
        $task->updated_at = date('Y-m-d H:i:s');
        
        if($task->save()) {
            return response([
                'status' => true,
                'message' => 'Task Shared',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Failed to Shared',
            ], 200);
        }
    }

    public function set_unshared_task($id) {
        $task = Task::find($id);

        $task->is_shared = 0;
        $task->updated_at = date('Y-m-d H:i:s');
        
        if($task->save()) {
            return response([
                'status' => true,
                'message' => 'Task UnShared',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Failed Unshare Task',
            ], 200);
        }
    }

    public function set_done_task($id) {
        $task = Task::find($id);

        $task->is_done = 1;
        $task->updated_at = date('Y-m-d H:i:s');
        
        if($task->save()) {
            return response([
                'status' => true,
                'message' => 'Task Shared',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Failed to Shared',
            ], 200);
        }
    }

    public function set_undone_task($id) {
        $task = Task::find($id);

        $task->is_done = 0;
        $task->updated_at = date('Y-m-d H:i:s');
        
        if($task->save()) {
            return response([
                'status' => true,
                'message' => 'Task UnShared',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Failed Unshare Task',
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $task = Task::all();
        return response([
            'status' => true,
            'message' => 'Daftar Task',
            'technicalMessage' => '',
            'datas' => $task
        ], 200);
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
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->owner = $request->owner;
        $task->is_shared = 0;
        $task->is_done = 0;
        $task->created_at = Carbon::now();
        if ($task->save()) {
            return response([
                'status' => true,
                'message' => 'Task saved',
            ],200);
        } else {
            return response([
                'status' => false,
                'message' => 'Failed to save',
            ],200);
        }
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
        // $task = Task::where('id', $id)->get();
        $task = Task::find($id);
        return response([
            'status' => true,
            'message' => 'Task Detail',
            'data' => $task
        ], 200);
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
        $task = Task::find($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->updated_at = date('Y-m-d H:i:s');
        
        if($task->save()) {
            return response([
                'status' => true,
                'message' => 'Task Updated',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Failed to Update',
            ], 200);
        }
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
        $task = Task::firstWhere('id', $id);
        if ($task) {
            Task::destroy($id);
            return response([
                'status' => true,
                'message' => 'Data dihapus',
            ],200);
        } else {
            return response([
                'status' => 'Not Found',
                'message' => 'Report tidak ditemukan'
            ],404);
        }
    }
}
