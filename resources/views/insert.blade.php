@extends('layouts.master')   
  @section('title', 'Register User')
@section('header')
  @extends('layouts.header') 
@stop 
  @section('content')
  <div class="container">
    <div class="row">
      <div class="col-6">
        @if (\Session::has('error'))
        <div class="alert alert-success msg">
        <ul>
          <li>{!! \Session::get('error') !!}</li>
        </ul>
        </div>
        @endif
        <a href="{{ url('/') }}"><button class="btn btn-success insrtbtn">All Listing</button></a>
        <h2> {{ $user->id ? 'Update' : 'Insert' }} User Info:-</h2>  
        <form method ="post" id="basic-form" action="{{ url('/insert_user') }}" enctype="multipart/form-data">
            @csrf
          <input type="hidden" name="id" value="{{{ $user->id }}}"> 
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp"value="{{  old('name', $user->name) }}">
            <span class="text-danger">{{ $errors->first('name') }}</span>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email</label>
            <input type="text" name="email" class="form-control @error('title') is-invalid @enderror" id="email" value="{{  old('email', $user->email) }}"> 
            <span class="text-danger">{{ $errors->first('email') }}</span>
          </div>
           @if(!isset($user->id))
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="passwd_reg" value={{$user->password}}> 
            <span class="text-danger">{{ $errors->first('password') }}</span>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" value={{$user->password}}> 
            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
          </div>
          @endif
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="exampleInputPassword1" accept=".jpg,.jpeg" value=""> 
            @if(isset($user->profile->image))
            <img src="{{ url('/uploads/'.$user->profile->image) }}" class="usr_image">
            @endif
            <span class="text-danger">{{ $errors->first('image') }}</span>
          </div>
          <button type="submit" class="btn btn-primary registerform">Submit</button>
        </form>
      </div>
    </div>
  </div>
  
  @stop
 @section('footer')
    @extends('layouts.footer') 
 @stop 


