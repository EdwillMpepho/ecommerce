<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Truck;
use DB;
class TruckController extends Controller
{
    /**
     * Create a new truck controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::orderBy('created_at','asc')->paginate(1);
        return view('pages.trucks')->with('trucks',$trucks);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
           'name'   => 'required',
           'engine' => 'required',
           'transmission' => 'required',
           'image' => 'image|nullable|max:1999',
           'power' => 'numeric|required',
           'price' => 'numeric|required',
          ]);

        // get values from input fields
        $truck_name = $request->input('name');
        $truck_engine = $request->input('engine');
        $truck_transmission = $request->input('transmission');
        $truck_power = $request->input('power');
        $truck_price = $request->input('price');
        $emp_id = $request->input('emp_id');
        $created_at = now();
        $updated_at = now();

        if($request->hasFile('image')) {
            //full image file name with extension
            $fullfileName = $request->file('image')->getClientOriginalName();
            //file name without extension
            $filename = pathinfo($fullfileName,PATHINFO_FILENAME);
            // file name extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // file name concatinate with extension
            $fileTobeUploaded = $filename.'_'.time().$extension;
            // store images
            $path = $request->file('image')->storeAs('public/cover_image/',$fileTobeUploaded);
        } else {
            $fileTobeUploaded = 'no image jpg';
        }

        $truck = DB::INSERT('insert into trucks(id,name,engine,transmission,power,price,image,
        created_at,updated_at,emp_id)values(?,?,?,?,?,?,?,?,?,?)',[null,$truck_name,$truck_engine,
        $truck_transmission,$truck_power,$truck_price,$fileTobeUploaded,$created_at,$updated_at,$emp_id]);

        if ($truck) {
            return redirect('/truck')->with('success_message','truck was successfully added');
        } else {
           return redirect('/admin')->with('error_message','Error,please check your insert statement');
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
         $trucks = DB::SELECT('select * from trucks where id =:id',['id' => $id]);
         if($trucks) {
             return view('pages.truck')->with('trucks', $trucks);
         } else {
             return redirect('/truck')->with('error_message','Truck is not found');
         }
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
