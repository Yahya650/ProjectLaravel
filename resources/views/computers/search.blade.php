@extends('layouts.app')
@section('title',"computers")
@section('content')

@auth
    <a href="{{route('computers.create')}}" class="btn btn-warning m-2 text-start">Add Computer</a>
@endauth

@if ($computers->count() > 0)
    <div class="d-flex gap-2 justify-content-center flex-wrap" >
        @foreach ($computers as $item)
            <div class="card mb-1" style="width: 18rem;">
                <img src="{{Storage::url($item->imageComputer)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$item->nameComputer}}</h5>
                    <figure class="">
                        <blockquote class="blockquote">
                        <p>From <strong>{{$item['originComputer']}}</strong> - <span class="text-success">{{$item['priceComputer']}}$</span></p>
                        </blockquote>
                        <figcaption class="blockquote-footer ">
                            Last Update <cite title="Source Title">{{$item['updated_at']}}</cite> created by {{$item->user->name}}
                        </figcaption>
                    </figure>
                    <a href="{{route('computers.show',$item->id)}}" class="m-1 btn btn-success">Regarder</a>
                    @auth
                        @if (Auth::id() == $item['user_id'])
                            <a href="{{route('computers.edit',$item->id)}}" class="m-1 btn btn-primary">Modify</a>
                            <form action="{{route('computers.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="m-1 btn btn-danger" value="Suprimer">
                            </form>
                        @endif
                    @endauth
                </div>  
            </div> 
        @endforeach
    </div>
    
    @else
        <div class="text text-center">
            <p>Not Found Computers</p>
        </div>
    @endif
    
@endsection