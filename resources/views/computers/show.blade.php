@extends('layouts.app')
@section('title',"computer")
@section('content')
    <h1>computers</h1>
    <p>THIS IS computers PAGE</p>
    <div class="img">
        <img src="{{Storage::url($computer['imageComputer'])}}" alt="" width="350px" srcset="">
    </div>
    <h3 class="mt-3">
        {{$computer['nameComputer']}} ( {{$computer['originComputer']}} ) - <strong>{{$computer['priceComputer']}}$</strong>
    </h3>
    @if (Auth::user() && Auth::id() == $computer['user_id'])
        <a href="{{route('computers.edit',[$computer['id']])}}" class="btn btn-success">Edit</a>
    @endif
    
@endsection