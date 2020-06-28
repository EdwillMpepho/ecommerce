@extends('layouts.app')
@section('content')
 <h1>View Our Cart</h1>
 <hr>
   @if (Cart::count())
   <div class="row">
    @foreach (Cart::content() as $row)
        <div class="col-sm-4">
         <img src="/storage/cover_image/{{$row->model->image}}" class="truck-gallery">
        </div>
        <div class="col-sm-8">
           <table class="table table-striped">
               <tr>
                   <th>Name </th>
                   <th>Price</th>
                   <th>Sub Total</th>
                   <th>Tax</th>
                   <th>Total</th>
                </tr>
               <tr>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->price }}</td>
                  <td>{{ Cart::subtotal()}}</td>
                  <td>{{ Cart::tax() }}</td>
                  <td>{{ Cart::total() }}</td>
                </tr>
           </table>
        </div>
     @endforeach
    </div>
    <div class="delete-cart">
        <table>
            <tr>
                <td>
                 <a class="btn btn-primary" href="/checkout/{{$row->id}}">Proceed</a>
                </td>
                <td>
                    <form action="{{route('cart.delete',$row->id)}}" method="POST" class="delete-cart">
                      {{ csrf_field() }}
                     <input type="hidden" name="_method" value="delete">
                     <button type="submit" class="btn btn-danger">Delete Cart</button>
                    </form>
                </td>
            </tr>
        </table>
       </div>
   @else
     <h3>There are no truck in the cart</h3>
   @endif
@endsection
