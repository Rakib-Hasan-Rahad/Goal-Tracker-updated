<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Goal;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $task = Task::orderBy('id', 'desc')->get();
        $taskCount = Task::count();
         return view('admin.task.index',['task'=>$task,'taskCount'=> $taskCount,]);  
    }

    public function tasklist($id)
    {
        # code...
        $task = Task::where('goal_id',$id)->orderBy('priority','desc')->orderBy('id', 'desc')->get();
        $taskCount = Task::where('goal_id',$id)->count();
        $goalAmount = Goal::where('id',$id)->count();
        $ghigh = Task::where('goal_id',$id)->where('priority','high')->count();
        $gmed = Task::where('goal_id',$id)->where('priority','medium')->count();
        $glow = Task::where('goal_id',$id)->where('priority','low')->count();

        $data = [
            'labels' => ['High', 'Medium', 'Low'],
            'values' => [$ghigh, $gmed, $glow]
        ];


        
        $gdone= Task::where('goal_id',$id)->where('status','done')->count();
        $gpending = Task::where('goal_id',$id)->where('status','pending')->count();
        $gdoing = Task::where('goal_id',$id)->where('status','doing')->count();
       if($taskCount == 0)
            $goalStatus=0;
        else
        $goalStatus = (($gdone)/$taskCount)*100;
        
        $data2 = [
            'labels' => ['Done', 'Pending', 'Doing'],
            'values' => [$gdone, $gpending, $gdoing]
        ];
    
          session()->put('goal_id',$id);
         return view('admin.task.index',['task'=>$task,'taskCount'=> $taskCount,'data'=>$data, 'data2'=>$data2, 'goalStatus' => $goalStatus]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $goal = Goal::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('admin.task.create',['goal'=>$goal]);
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
        $task = Task::create($request->all());
     

        if(Auth::user()->role == "user")
            return redirect()->back()->with('success','Data inserted successfully');
        else
            return redirect()->route('task.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        $goal = Goal::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('admin.task.edit',[
            'edit' => $task,
            'goal' => $goal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $task->update($request->all());


        if(Auth::user()->role == "user")
            return redirect()->back()->with('success','Data inserted successfully');
        else
            return redirect()->route('task.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('task.index')->with('status','Data deleted successfully!');
    }
}
