@extends('layouts.app')

@section('content')
    <div id="title" style="text-align: center;">
        <h1>Learn Laravel 5</h1>
        <div style="padding: 5px; font-size: 16px;">Learn Laravel 5</div>
    </div>
    <hr>
    <div id="content">
        <ul>
            @foreach ($users as $user)
                <li style="margin: 50px 0;">
                    <div class="title">
                        <a href="#">
                            <h4>{{ $user->nick_name }}</h4>
                        </a>
                    </div>
                    <div class="body">
                        <p>{{ $user->password }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
