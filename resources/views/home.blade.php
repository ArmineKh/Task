@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                
                     @if(Auth::user()->id != 1 && Auth::user()->verify != 1)

                      <form method="post" action="{{URL::to('/sendMessage') }}">
                        {{csrf_field()}}

                        <div class="form-group">
                            {{$errors->first('name')}} 
                            <label for="exampleInputEmail1">User name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            {{$errors->first('email')}} 
                            <label for="exampleInputEmail2">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                       <div class="form-group">
                        {{$errors->first('subject')}} 
                            <label for="exampleInputEmail3">Subject</label>
                            <input type="text" name="subject" class="form-control" id="exampleInputEmail3" placeholder="Enter message subject">
                        </div>
                        <div class="form-group">
                            {{$errors->first('message')}} 
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3"></textarea>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary">Send</button>
                    </form>

                    @endif

                    <div class="container">
                        Welcom you are verify!
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
