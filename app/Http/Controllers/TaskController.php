<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\ValidateTask;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param\App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function index(Task $task)
    {
        try{  
            return response()->json(["status"=>true,"data"=>$task->get(),"message"=>"Task was successfully retrieved"], 200);
        }catch(Exception $e){
                response()->json(["status"=>false,"data"=>null,"message"=>"Failed to retrive task "], 412);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateTask  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response Json
     */
    public function store(ValidateTask $request, Task $task)
    {
        //
        try{
            $task->title=$request->title;
            $task->description=$request->description;
            if($task->save()) return response()->json(["status"=>true,"data"=>$task,"message"=>"Task was successfully created"], 201);
            else response()->json(["status"=>false,"data"=>null,"message"=>"Failed to create new task "], 412);
        }catch(Exception $e){
            response()->json(["status"=>false,"data"=>null,"message"=>"Failed to create task "], 412);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        try{
             return response()->json(["status"=>true,"data"=>$task,"message"=>"Task was successfully retrieved"], 200);
        }catch(Exception $e){
            response()->json(["status"=>false,"data"=>null,"message"=>"Failed to retrive task "], 412);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ValidateTask  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateTask $request, Task $task)
    {
        try{
            $task->title=isset($request->title) ? $request->title : $task->title  ;
            $task->description=isset($request->description) ? $request->description : $task->description  ;
        if($task->update()) return response()->json(["status"=>true,"data"=>$task,"message"=>"Task update was successfully done"], 200);
            else response()->json(["status"=>false,"data"=>null,"message"=>"Failed to update new task "], 412);
        }catch(Exception $e){
            response()->json(["status"=>false,"data"=>null,"message"=>"Failed to update task "], 412);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $task
     * @return \Json response
     */
    public function destroy(Task $task)
    {
        //
        try{
             if($task->delete()) return response()->json(["status"=>true,"data"=>$task,"message"=>"Task was successfully deleted"], 200);
             else response()->json(["status"=>false,"data"=>null,"message"=>"Failed to delete task "], 412);
        }catch(Exception $e){
            response()->json(["status"=>false,"data"=>null,"message"=>"Failed to delete task "], 412);
        }

    }
}
