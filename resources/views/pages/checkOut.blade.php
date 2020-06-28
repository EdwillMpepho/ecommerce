@extends('layouts.app')
@section('content')
  <h1>Check Out</h1>
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
    <div class="add-payment">
    <form id="payment-form" method="POST" class="frm-payment" action="{{route('checkout.store')}}">
            {{ csrf_field() }}
             <input type="hidden" name="amount" value="{{Cart::total()}}">
             <input type="hidden" name="truckName" value="{{$row->name}}">
             <input type="hidden" name="truckid" value="{{$row->id}}">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter the name on the card" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter you email address" required>
            </div>
            <div class="form-group">
              <div id="card-element">
              <!-- Elements will create input elements here -->
              </div>
            </div>
            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>
             <input type="submit" class="btn-pay" id="btnPayment" value="Submit" class="btn btn-default">
          </form>
   @else
     <h3>There are no truck in the cart</h3>
   @endif
@endsection

