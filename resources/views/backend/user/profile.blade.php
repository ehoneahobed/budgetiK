@extends('backend.admin_master')

@section('main_content')
<div class="py-12 row">
    <div class="container">
        <div class="row col-md-8 mt-2 offset-md-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update User Profile
            </h2>
        </div>
        <div class="col-md-8 offset-2 mt-2">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="name" class="form-control" id="name" value="{{ $user['name'] }}">
                </div>
                
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $user['email'] }}">
                  <div id="emailHelp" class="form-text"></div>
                </div>
                
                <div class="col-md-5">
                    <label for="user" class="form-label">Current Profile Photo </label>
                    <img src="{{ asset('storage/'.$user['profile_photo_path']) }}" class="rounded-circle" alt="" width="200">
                </div><br><br>
                <div class="form-group col-md-5">
                    <label for="exampleFormControlFile1">Profile Photo</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
              
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
        </div>
        
        
    </div>
</div>
@endsection