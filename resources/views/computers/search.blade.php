@extends('layouts.app')
@section('title', 'computers')
@section('content')

    @if ($computers->count() > 0)
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            @foreach ($computers as $item)
                <div class="card mb-1" style="width: 18rem;">
                    <img src="{{ Storage::url($item->imageComputer) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nameComputer }}</h5>
                        <figure class="">
                            <blockquote class="blockquote">
                                <p>From <strong>{{ $item['originComputer'] }}</strong> - <span
                                        class="text-success">{{ $item['priceComputer'] }}$</span></p>
                            </blockquote>
                            <figcaption class="blockquote-footer ">
                                Last Update <cite title="Source Title">{{ $item['updated_at'] }}</cite> created by
                                {{ $item->user->name }}
                            </figcaption>
                        </figure>
                        <a href="{{ route('computers.show', $item->id*789456654987) }}" class="m-1 btn btn-success">Regarder</a>
                        @auth
                            @if (Auth::id() == $item['user_id'])
                                <a href="{{ route('computers.edit', $item->id*789456654987) }}" class="m-1 btn btn-primary">Modify</a>
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $loop->iteration }}">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">ALERT</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span class="text-danger text-bold"><strong>Are you sure you want to delete your
                                                Computer
                                                ?</strong></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <form action="{{ route('computers.destroy', $item->id*789456654987) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="m-1 btn btn-danger" value="Yes">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
