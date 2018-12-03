@extends('layouts.app')

@section('content')
    <h1>This is  Contact Page</h1>

    @if(count($people))
        <ul>
            @foreach($people as $person)
                <li>{{$person}}</li>
            @endforeach
        </ul>
    @endif

@endsection

@section('footer')
    <script>
        alert('Hello There');
    </script>
@endsection