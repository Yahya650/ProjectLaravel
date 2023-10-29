@extends('layouts.app')
@section('title', $computer->nameComputer)
@section('bg_color', 'white')
@section('style')
    <style>
        .card {
            display: flex;
            flex-direction: column;
            width: clamp(20rem, calc(20rem + 2vw), 22rem);
            overflow: hidden;
            box-shadow: 0 .1rem 1rem rgba(0, 0, 0, 0.1);
            border-radius: 1em;
            background: #ECE9E6;
            background: linear-gradient(to right, #FFFFFF, #ECE9E6);

        }



        .card__body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }


        .tag {
            align-self: flex-start;
            padding: .25em .75em;
            border-radius: 1em;
            font-size: .75rem;
        }

        .tag+.tag {
            margin-left: .5em;
        }

        /* .tag-blue {
            background: #56CCF2;
            background: linear-gradient(to bottom, #2F80ED, #56CCF2);
            color: #fafafa;
        } */

        .tag-green {
            background: #50C878;
            background: linear-gradient(to bottom, #5cd585, #0bbc46);
            color: #fafafa;
        }

        .tag-red {
            background: #cb2d3e;
            background: linear-gradient(to bottom, #ef473a, #cb2d3e);
            color: #fafafa;
        }

        .card__body h4 {
            font-size: 1.5rem;
            text-transform: capitalize;
        }

        .card__footer {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            margin-top: auto;
        }

        .user {
            display: flex;
            gap: .5rem;
        }

        .user__image {
            border-radius: 50%;
        }

        .user__info>small {
            color: #666;
        }
    </style>
@endsection

@section('content')
    {{-- <h1>computer</h1>
    <p>THIS IS computer PAGE</p> --}}
    <div class="card">
        <div class="card__header">
            <img src="{{ Storage::url($computer->imageComputer) }}" alt="card__image" class="card__image" style="width: clamp(20rem, calc(20rem + 2vw), 22rem); border-radius:10px">
        </div>
        <div class="card__body">
            <span class="tag tag-red">Origin : <strong>{{ $computer->originComputer }}</strong></span>
            <h4>{{ $computer->nameComputer }}</h4>
            <p>{{ $computer->desc }}</p>
            <span class="tag tag-green">Price : {{ $computer->priceComputer }} $</span>
        </div>
        <div class="card__footer">
            <div class="user">
                <img src="{{ Storage::url($computer->user->profileImg) }}" alt="user__image" width="50px" height="50px" class="user__image ">
                <div class="user__info">
                    <h5 class="mb-0">{{ $computer->user->name }}</h5>
                    <small class="mt-0">
                        Last Update <br> <cite title="">{{ $computer['updated_at'] }}</cite>
                    </small>
                </div>
            </div>
            @if (Auth::user() && Auth::id() == $computer->user_id)
                <div>
                    <a href="{{ route('user.computers.edit', [$computer->id * 789456654987]) }}"
                        class="btn btn-success">Edit</a>
                </div>
            @endif
        </div>
    </div>


@endsection


