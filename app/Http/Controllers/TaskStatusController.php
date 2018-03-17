<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskStatus;
use PHPUnit\Framework\Exception;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = TaskStatus::paginate(10);
        return view('status.index', ['taskStatuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'statusName' => 'required|string|max:50|unique:task_statuses'
        ]);
        TaskStatus::create(['name' => $request->statusName]);
        flash('Task status added successfuly!')->success();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $status = TaskStatus::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->withStatus(404);
        }
        if ($id == 1) {
            flash("You can't edit this status")->error();
            return redirect()->back();
        }
        return view('status.edit', ['taskStatus' => $status]);
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
        $request->validate([
            'statusName' => 'required|string|max:50|unique:task_statuses'
        ]);
        try {
            $status = TaskStatus::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->withStatus(404);
        }
        if ($id == 1) {
            flash("You can't edit this status")->error();
            return redirect()->back();
        }
        $status->name = $request->statusName;
        $status->save();
        flash('Task status changed successfuly!')->success();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $status = TaskStatus::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->withStatus(404);
        }
        if ($id == 1) {
            flash("You can't delete this status")->error();
            return redirect()->back();
        }
        $status->delete();
        flash("Task status deleted successfuly")->warning();
        return redirect()->back();
    }
}
