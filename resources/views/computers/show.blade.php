@extends('layouts.app')
@section('title', 'computer')
@section('bg_color','white')

@section('content')
    <h1>computer</h1>
    <p>THIS IS computer PAGE</p>
    <div class="img">
        <img src="{{ Storage::url($computer['imageComputer']) }}" alt="" width="350px" srcset="">
    </div>
    <h3 class="mt-3">
        {{ $computer['nameComputer'] }} ( {{ $computer['originComputer'] }} ) -
        <strong>{{ $computer['priceComputer'] }}$</strong>
    </h3>
    @if (Auth::user() && Auth::id() == $computer['user_id'])
        <a href="{{ route('computers.edit', [$computer['id'] * 789456654987]) }}" class="btn btn-success">Edit</a>
    @endif

@endsection
