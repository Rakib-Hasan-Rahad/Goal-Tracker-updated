<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Auth;
class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'user'){
            $goal = Goal::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
            $goalCount = Goal::where('user_id',Auth::user()->id)->count();
        }
           
        else{
            $goal = Goal::orderBy('id', 'desc')->get();
            $goalCount = Goal::count();
        }
            
            
     
         return view('admin.goal.index',['goal'=>$goal,'goalCount'=> $goalCount,]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goal.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goal = Goal::create($request->all());
     


        return redirect()->route('goal.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
       
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        return view('admin.goal.edit',[
            'edit' => $goal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $goal->update($request->all());


        return redirect()->route('goal.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('goal.index')->with('status','Data deleted successfully!');
    }
}
