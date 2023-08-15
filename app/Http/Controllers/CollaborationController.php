<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Goals;
use Auth;
class CollaborationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listUser($id)
    {
        # code...
        $users = User::where('role','user')->get();
        return view('admin.user.all_user',['users'=> $users,'goal_id'=>$id]);
    }

    public function send(Request $request)
    {
        # code...
        $collab = Collaboration::where('goal_id',$request->goal_id)->where('user_id',$request->user_id)->first();
       /* if(@$collab->send_status == 1){
             return redirect()->back()->with('message','Already Sent !!');
        }*/
        $collaboration = Collaboration::create($request->all());
     


        return redirect()->back()->with('success','Invitation send successfully');

    }

    public function accept(Request $request)
    {
        # code...
        $id = $request->id;
        $collab = Collaboration::find($id);
    //    dd($collab);
        $collab->status = 1;
        $collab->save();
        return redirect()->back()->with('success','Accepted!');


    }

    public function collab()
    {
        # code...
        $collab = Collaboration::where('collab_id',Auth::user()->id)->orderBy('id','desc')->get();
       // dd($collab);
        return view('admin.user.invitation',['collab'=>$collab]);
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
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function show(Collaboration $collaboration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaboration $collaboration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collaboration $collaboration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaboration $collaboration)
    {
        //
    }
}
