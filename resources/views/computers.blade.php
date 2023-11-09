@extends('layouts.app')
@section('title', 'computers')
@section('script')
    <script src="https://kit.fontawesome.com/419916fcd2.js" crossorigin="anonymous"></script>
@endsection
@section('bg_color',
    'background: rgb(238,174,202);
    background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        #body {

            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
            gap: 0rem;
            padding: 1rem;
        }

        #card {
            height: fit-content;
            display: flex;
            flex-direction: column;
            padding: 1rem 1rem 2rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.2), 0 0 40px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        #card>#divImage>#imgComputer {
            border-radius: 5px;
            border: 2px solid black;
            width: 100%;
            /* height: auto; */
            aspect-ratio: 600/400;
        }

        #card>#divImage>#imgOwner {
            border: 2px solid black;

        }

        #card>h2 {
            margin-top: 1rem;
            /* font-family: "Kalam", cursive; */
            font-weight: normal;
            font-size: 2rem;
            color: #4a4a7d;
            text-align: start;
        }

        #card>p {
            font-family: "Kalam", cursive;
            font-size: 1rem;
            color: #5e5e89;
            text-align: center;
        }
    </style>
    @php
        $rotations = [3.684642195272115, 1.512250459647726, 3.3480805434852297, 1.782033916287964, 3.069916010610683, -4.382592752584227, 0.9813713035306275, 2.927697051453957, -4.24458886289528, -2.5749013006800103, 1.4168864224385036, 1.4308769699012753, 4.577441229431688, 3.3754907272510355, -2.8974970104407616, -0.8133094012313276, -1.3981981973681656, -2.7829664774357665, 4.982548550637064];
    @endphp
    <div id="body" class="mb-3">
        @if ($computers->count() > 0)
            @foreach ($computers as $item)
                <div class="" id="card" style="transform:rotate({{ Arr::random($rotations) }}deg);">

                    <div id="divImage" class="position-relative mb-2">
                        <img id="imgOwner" src="{{ Storage::url($item->User->profileImg) }}"
                            class="position-absolute top-100 start-50 translate-middle rounded-pill"
                            style="width:50px; height:50px" alt="">
                        <img id="imgComputer" src="{{ Storage::url($item['imageComputer']) }}" />
                    </div>
                    <h2 class="mt-4">{{ $item['nameComputer'] }}</h2>
                    <div class="">
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
                    </div>
                    <div class="btns d-flex">
                        <a href="{{ route('computers.show', Str::studly(base64_encode($item->id))) }}" id="show"
                            class="mx-1 btn btn-success"><i class="fa-regular fa-eye" style="color: #fafafa;"></i></a>
                        @auth
                            @if (Auth::id() == $item['user_id'])
                                <a href="{{ route('user.computers.edit', $item->id * 789456654987) }}"
                                    class="mx-1 btn btn-primary"><i class="bi bi-pencil-square"></i></a>

                                <!-- Button delete -->
                                <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $loop->iteration }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
                <!-- Modal for delete -->
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
                                <form action="{{ route('user.computers.destroy', $item->id * 789456654987) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="m-1 btn btn-danger" value="Yes">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text text-center">
                <p>Not Found Computers</p>
            </div>
        @endif
    </div>
@endsection











{{-- @extends('layouts.app')
@section('title', 'Blogs')
@section('content')

    <h2>All Computers</h2>
    <p>THIS IS Computers PAGE</p>
    

    @if ($computers->count() > 0)
        <div class="d-flex gap-2 justify-content-center flex-wrap" id="AllData">
            @foreach ($computers as $item)
                <div class="card mb-1" style="width: 18rem;" id="card">
                    <img src="{{ Storage::url($item['imageComputer']) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['nameComputer'] }}</h5>
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
                        <a href="{{ route('computers.show', $item->id*789456654987) }}" id="show"
                            class="m-1 btn btn-success">Regarder</a>
                        @auth
                            @if (Auth::id() == $item['user_id'])
                                <a href="{{ route('computers.edit', $item->id*789456654987) }}" class="m-1 btn btn-primary">Modify</a>

                                <!-- Button delete -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $loop->iteration }}">
                                    Delete
                                </button>

                                <!-- Modal for delete -->
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
        <div class="d-flex mt-2">
            {{ $computers->links() }}
        </div>
    @else
        <div class="text text-center">
            <p>Not Found Computers</p>
        </div>
    @endif




@endsection



 --}}
