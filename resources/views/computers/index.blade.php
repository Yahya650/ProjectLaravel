@extends('layouts.app')
@section('title',"computers")
@section('content')
    @if ($msg = Session::get('success'))
        <div class="m-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$msg}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>  
    @endif
    <h1>computers</h1>
    <p>THIS IS computers PAGE</p>
    @auth
        <a href="{{route('computers.create')}}" class="btn btn-warning m-2 text-start">Add Computer</a>
    @endauth

    @if ($computers->count() > 0)
        @php
            $t = 0
        @endphp
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            @foreach ($computers as $Computer)
                @if (Auth::user() && Auth::id() == $Computer['user_id'])
                    @php
                        $t = 1;
                    @endphp
                    <div class="card" style="width: 18rem;">
                        <img src="{{Storage::url($Computer['imageComputer'])}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$Computer['nameComputer']}}</h5>
                            <figure class="">
                                <blockquote class="blockquote">
                                    <p>From <strong>{{$Computer['originComputer']}}</strong> - <span class="text-success">{{$Computer['priceComputer']}}$</span></p>
                                </blockquote>
                                <figcaption class="blockquote-footer ">
                                    Last Update <cite title="Source Title">{{$Computer['updated_at']}}</cite> created by {{$Computer->user->name}}
                                </figcaption>
                            </figure>
                            <a href="{{route('computers.show',$Computer->id)}}" class="m-1 btn btn-success">Regarder</a>
                            <a href="{{route('computers.edit',$Computer->id)}}" class="m-1 btn btn-primary">Modify</a>
                            <form action="{{route('computers.destroy',$Computer->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="m-1 btn btn-danger" value="Suprimer">
                            </form>
                        </div>  
                    </div> 
                @endif
            @endforeach
            @if ($t == 0)
                <div class="text text-center">
                    <p>You dont have Computers</p>
                </div>
            @endif
        </div>
        <div class="d-flex mt-2">
            {{$computers->links()}}
        </div>
    @else
        <div class="text text-center">
            <p>You dont have Computers</p>
        </div>
    @endif
    
@endsection