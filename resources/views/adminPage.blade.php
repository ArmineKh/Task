@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            @foreach($users as $u)
                            @foreach($message as $m)

                            <div class="col-md-4">
                                <h3>User name: <b>{{$u->name}}</b></h3>
                                <h4>User email: <b>{{$u->email}}</b></h4>
                                @if($m->user_id == $u->id)
                                <h4>Message subject: <b>{{$m->subject}}</b></h4>
                                <textarea>{{$m->message}}</textarea>
                                @endif
                                <button class="btn btn-primary">
                                    <a  style="text-decoration:none; color: black" href="{{URL::to('/')}}/verify/{{$u->id}}">Verify</a> 
                                </button>
                                <button class="btn btn-danger">
                                    <a  style="text-decoration:none; color: black" href="{{URL::to('/')}}/delete/{{$u->id}}">Delete</a> 
                                </button>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
