<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' =>['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = DB::select('select * from trucks') ;
        return view('pages.cart')->with('truck',$trucks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $trucks = DB::SELECT('select * from trucks where id =:id',['id' => $id]);
        if($trucks) {
            return view('pages.addToCart')->with('trucks',$trucks);
        } else {
            return redirect('/truck')->with('error_message','Truck is not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $truckId = $request->input('truckid');
            $truckName = $request->input('name');
            $truckPrice = $request->input('price');
            $user_id = auth()->user()->id;
            $qty = 1;
            $created_at = now();
            $updated_at = now();
            //add items to cart
            Cart::add($truckId, $truckName,$qty,$truckPrice,3050)->associate('App\Truck');
            //insert item to the database
            $cart = DB::insert('insert into carts(id,name,price,quantity,truck_id,user_id,
            created_at,updated_at)values(?,?,?,?,?,?,?,?)',[null,$truckName,$truckPrice,$qty,
            $truckId,$user_id,$created_at,$updated_at]);
            return redirect('/cart')->with('success_message','Item was added successfully');
          } catch(CartAlreadyStoredException $ex) {
            Cart::destroy();
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
    public function removeCart($rowId){
        Cart::destroy($rowId);
        return redirect('/cart')->with('success_message','Iterm in cart was deleted successfully');
    }
}
