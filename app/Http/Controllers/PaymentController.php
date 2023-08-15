<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $payment = Payment::whereBetween('created_at', [$startDate, $endDate])->orderBy('id','desc')->get();
        $paymentCount = Payment::whereBetween('created_at', [$startDate, $endDate])->count();
        if(Auth::user()->role == "admin"){
            $payment = Payment::whereBetween('created_at', [$startDate, $endDate])->orderBy('id','desc')->get();
            $paymentCount = Payment::whereBetween('created_at', [$startDate, $endDate])->count();
        }elseif(Auth::user()->role == "user"){
            $payment = Payment::where('user_id',Auth::user()->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('id','desc')->first();
            $paymentCount = Payment::where('user_id',Auth::user()->id)->whereBetween('created_at', [$startDate, $endDate])->count();
        }

        return view('admin.payment.index',['payment'=>$payment,'paymentCount'=> $paymentCount,]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = Payment::create($request->all());
        return redirect()->route('payment.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function approve($id)
    {
        # code...
        $payment = Payment::find($id);
        $payment->status = 1;
        $payment->save();
         return redirect()->back()->with('success','Data updated successfully!');
    }

    public function disapprove($id)
    {
        # code...
        $payment = Payment::find($id);
        $payment->status = 0;
        $payment->save();
         return redirect()->back()->with('success','Data updated successfully!');
    }
}
