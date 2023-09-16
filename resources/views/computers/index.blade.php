@extends('layouts.app')
@section('title', 'computers')
@section('content')
    <h1>computers</h1>
    <p>THIS IS computers PAGE</p>
    
    @if ($computers->count() > 0)
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            @foreach ($computers as $Computer)
                <div class="card" style="width: 18rem;">
                    <img src="{{ Storage::url($Computer['imageComputer']) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $Computer['nameComputer'] }}</h5>
                        <figure class="">
                            <blockquote class="blockquote">
                                <p>From <strong>{{ $Computer['originComputer'] }}</strong> - <span
                                        class="text-success">{{ $Computer['priceComputer'] }}$</span></p>
                            </blockquote>
                            <figcaption class="blockquote-footer ">
                                Last Update <cite title="Source Title">{{ $Computer['updated_at'] }}</cite> created by
                                {{ $Computer->user->name }}
                            </figcaption>
                        </figure>
                        <a href="{{ route('computers.show', $Computer->id * 789456654987) }}"
                            class="m-1 btn btn-success">Regarder</a>
                        <a href="{{ route('computers.edit', $Computer->id * 789456654987) }}"
                            class="m-1 btn btn-primary">Modify</a>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form action="{{ route('computers.destroy', $Computer->id * 789456654987) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="m-1 btn btn-danger" value="Yes">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex mt-2">
            {{ $computers->links() }}
        </div>
    @else
        <div class="text text-center">
            <p>You dont have Computers</p>
        </div>
    @endif

@endsection
