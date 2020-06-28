@extends('layouts.app')
@section('content')
<h1>Single Truck</h1>
 <hr/>
    <div class="our-product">
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
             <a class="btn btn-primary" href="/cart/add/{{ $truck->id }}">Add Truck For Purchase</a>
          </div>
       </div>
      @else
        <h3>There are no trucks available</h3>
      @endif
    </div>
@endsection


