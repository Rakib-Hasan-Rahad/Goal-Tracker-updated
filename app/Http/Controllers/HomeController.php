<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Task;
use App\Models\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == "user") {
            # code...
            $goalCount = Goal::where('user_id',Auth::user()->id)->count();
            $taskCount=0;
            $userCount=0;
            $gmed = Goal::where('user_id',Auth::user()->id)->where('priority','medium')->count();
            $ghigh = Goal::where('user_id',Auth::user()->id)->where('priority','high')->count();
            $glow = Goal::where('user_id',Auth::user()->id)->where('priority','low')->count();
            $data = [
                'labels' => ['High', 'Medium', 'Low'],
                'values' => [$ghigh, $gmed, $glow]
            ];

        }else{
                    # code...
            $goalCount = Goal::count();
            $taskCount = Task::count();
            $userCount = User::count();
            $gmed = Goal::where('priority','medium')->count();
            $ghigh = Goal::where('priority','high')->count();
            $glow = Goal::where('priority','low')->count();
            $data = [
                'labels' => ['High', 'Medium', 'Low'],
                'values' => [$ghigh, $gmed, $glow]
            ];
        }
    
        return view('admin.dashboard',['goalCount'=>$goalCount,'userCount' => $userCount,'taskCount'=>$taskCount,'data'=>$data]);
    }
}
