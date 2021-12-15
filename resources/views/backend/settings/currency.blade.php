@extends('backend.admin_master')

@section('main_content')

<div class="py-12 row">
    <div class="container">
        
        <h3>Currency Settings</h3>
        <div class="row col-md-12 mt-4 ml-5">
            
            <div class="card col-md-10">
                <!-- show alert message if exists -->
                @if (session('success'))
                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

                <div class="card-header">Set Default Currency</div>
                <div class="card-body">
                   <h4> </h4>
                    <form action="{{ route('currency.activating') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 col-md-5">
                          <label for="exampleInputEmail1" class="form-label"></label>
                          <select class="form-control" name="currency_id" id="">
                              <option value="" >Choose a Currency</option>
                              @foreach ($currencies as $currency )
                                  <option value="{{ $currency->id }}">{{ $currency->currency_name ." | ". $currency->currency_code }}</option>
                              @endforeach
                          </select>
                        
                            @error('category_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror  

                        </div>
                                
  
                            
                          
                        
                        <button type="submit" class="btn btn-primary">Set Currency</button>
                      </form>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>



@endsection