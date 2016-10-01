@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        This is the demo page for the Laravel and Angular task list. <br/>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <a href="{{ url('/register') }}">Register</a> an account or
                            <a href="{{ url('/login') }}">Login</a> to use the task list.
                        @else
                            Would you like to see your <a href="{{ url('/tasks') }}">Task List</a>?
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
