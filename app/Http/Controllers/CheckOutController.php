<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;


class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $trucks = DB::select('select * from trucks where id =:id',['id' => $id]);
        return view('pages.checkOut')->with('trucks',$trucks);
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
        $name = $request->input('name');
        $email = $request->input('email');
        $truckName = $request->input('truckName');
        $truck_id = $request->input('truckid');
        $user_id = auth()->user()->id;
        $created_at = now();
        $updated_at = now();
        $total_amount = $request->input('amount');
        $new_total = str_replace(',','',$total_amount);
        $new_amount = str_replace('.','',$new_total);
        $amount = substr($new_amount,0,6);
        try{
            \Stripe\Stripe::setApiKey('your information');
            // `source` is obtained with Stripe.js; see https://stripe.com/docs/payments/accept-a-payment-charges#web-create-token
            \Stripe\Charge::create([
              'amount' => $amount,
              'currency' => 'usd',
              'source' => $request->stripeToken,
              'description' => 'Payment',
              'receipt_email' => $email
            ]);

            //insert booking to final bookings for ensuring customer pay all the amount
            $final_payment = DB::insert('insert into orders(id,name,email,truckName,amount,user_id,
            truck_id,created_at,updated_at) values(?,?,?,?,?,?,?,?,?)',[null,
            $name,$email,$truckName,$amount,$user_id,$truck_id,$created_at,$updated_at]);

            Cart::instance('default')->destroy();
            if ($final_payment) {
                return redirect('/thankyou')->with('success_message','Thank you for choosing us, Have a nice stay');
            }


           }
           catch(Exception $ex) {
             return redirect('/truck')->with('error_message', $ex->getMessage());
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
