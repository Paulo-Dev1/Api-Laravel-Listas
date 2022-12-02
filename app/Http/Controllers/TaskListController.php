<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Http\Requests\StoreTaskListRequest;
use App\Http\Requests\UpdateTaskListRequest;
use App\Services\ResponseService;
use App\Transformers\TaskList\TaskListResourceCollection;

class TaskListController extends Controller
{
    private $tasklist;

    public function __construct(TaskList $tasklist )
    {
        $this->tasklist = $tasklist;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TaskListResourceCollection($this->tasklist->index());
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
     * @param  \App\Http\Requests\StoreTaskListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskListRequest $request)
    {
        try {
            $data = $this->tasklist
            ->create($request->all());
        } catch (\Throwable $e) {
            return ResponceService::exception('tasklis.store',null,$e);
        }

        return new TaskListResource($data,array('type'=>'store','route'=>'tasklist.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data=$this->tasklist->show($id);
        } catch (\Throwable $e) {
            return ResponseService::exception('taslist.show',$id,$e);
        }

        return new TaskListResource($data,array('type' => 'show','route' => 'tasklist.show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskList $taskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskListRequest  $request
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskListRequest $request, $id)
    {
        try{        
            $data = $this
            ->tasklist
            ->updateList($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.update',$id,$e);
        }

        return new TaskListResource($data,array('type' => 'update','route' => 'tasklist.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = $this
            ->tasklist
            ->destroyList($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('tasklist.destroy',$id,$e);
        }
        return new TaskListResource($data,array('type' => 'destroy','route' => 'tasklist.destroy'));
    }
}
