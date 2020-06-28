@extends('layouts.app')
@section('content')
 <h1>Add Truck</h1>
 <hr/>
 @if($password === 'met1989')
 <div class="row">
     <div class="col-xs-12">
         <div class="form-add-truck">
             <form action="{{ route('truck.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="emp_id" value="{{ $employeeid }}">
                <div class="form-group">
                   <input type="text" name="name" class="form-control" placeholder="enter truck name" required>
                </div>
                <div class="form-group">
                   <input type="text" name="engine" class="form-control" placeholder="enter truck engine" required>
                 </div>
                 <div class="form-group">
                    <input type="text" name="transmission" class="form-control" placeholder="enter truck transmission" required>
                 </div>
                 <div class="form-group">
                   <input type="text" name="power" class="form-control" placeholder="enter truck power" >
                 </div>
                 <div class="form-group">
                    <input type="text" name="price" class="form-control" placeholder="enter truck price" >
                 </div>
                 <div class="form-group">
                    <label>Truck Image:</label>
                    <input type="file" name="image" class="form-control">
                 </div>
                 <button type="submit" class="btn btn-default">Save</button>
             </form>
         </div>
     </div>
 </div>
 @else
    <h4>you are unauthorized to peform this operation</h4>
 @endif
@endsection
