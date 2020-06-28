@extends('layouts.app')
@section('content')
 <h1>Add To Cart</h1>
 <hr>
   @if (count($trucks) > 0)
   <div class="row">
    @foreach ($trucks as $truck)
        <div class="col-sm-4">
         <img src="/storage/cover_image/{{$truck->image}}" class="truck-gallery">
        </div>
        <div class="col-sm-8">
           <table class="table table-striped">
               <tr>
                   <th>Name </th>
                   <th>Engine</th>
                   <th>Transmission</th>
                   <th>Power</th>
                   <th>Price</th>
               </tr>
               <tr>
                  <td>{{ $truck->name }}</td>
                  <td>{{ $truck->engine }}</td>
                  <td>{{ $truck->transmission }}</td>
                  <td>{{ $truck->power }}</td>
                  <td>${{ $truck->price }}</td>
               </tr>
           </table>
        </div>
   @endforeach
   <div class="btn-add-cart">

     <form action="{{route('cart.store')}}" method="POST">
           {{ csrf_field() }}
        <input type="hidden" name="truckid" value="{{$truck->id}}">
        <input type="hidden" name="name" value="{{$truck->name}}">
        <input type="hidden" name="price" value="{{$truck->price}}">
        <button type="submit" class="btn btn-primary">Add Truck To Cart</button>
      </form>

   </div>
</div>
   @else
     <h3>There are no truck in the cart</h3>
   @endif
@endsection
