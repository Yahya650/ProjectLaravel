@extends('layouts.app')
@section('title', $user->name)
@section('bg_color',
    'background: rgb(238,174,202);
    background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);')

    {{-- @dd($computersUser) --}}

    {{-- Style Page User --}}
@section('style')
    <link rel="stylesheet" href="{{ url('/css&js/profileStyle.css') }}">
@endsection
{{-- End Style Page User --}}

{{-- Script Page User --}}
@section('script')
    <script src="{{ url('/css&js/profileScript.js') }}"></script>
    <script src="https://kit.fontawesome.com/419916fcd2.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $("#fEditUser").submit(function(e) {
                if (!$('#flexRadioDefault1').prop('checked') && !$('#flexRadioDefault2').prop('checked')) {
                    e.preventDefault(); // Prevent form submission
                    $("#msgSexeRequired").removeClass("d-none");
                } else {
                    $("#msgSexeRequired").addClass("d-none");
                }
            });
        })
    </script>
@endsection

{{-- End Script Page User --}}
@section('script')

@endsection

@section('content')
    <style>
        #containerImage {
            position: relative;
            width: 80px;
        }

        #top-left-button {
            position: absolute;
            top: -7px;
            right: -5px;
        }
    </style>


    <div class="mt-5 row d-flex justify-content-center align-items-center w-100">



        <div class=" col col-lg-12 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="col-md-4 gradient-custom text-center"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

                        {{-- Image Profile --}}
                        <div id="containerImage" class="mx-auto my-5">
                            <img id="RealeImageProfile" class="img-fluid rounded-pill" style="width: 80px;"
                                src="{{ Storage::url($user->profileImg) }}" alt="Your Image">
                            @auth
                                @if (Auth::user()->email_verified_at != null)
                                    <button type="button" id="top-left-button" data-bs-toggle="modal"
                                        data-bs-target="#addProfile" style="background-color: transparent; border:none;"
                                        class="p-1"><i class="fa-solid fa-pencil fa-beat-fade"
                                            style="color: #000205;"></i></button>
                                @endif
                            @endauth

                        </div>



                        {{-- Name --}}
                        <h5>{{ $user->name }}
                            @if (Auth::user()->email_verified_at != null)
                                <span><img src="{{ Storage::url('verified.png') }}" width="30px" alt=""></span>
                            @else
                                <span><img src="{{ Storage::url('verified-account.png') }}" width="30px"
                                        alt=""></span>
                            @endif
                        </h5>

                        {{-- Sexe --}}
                        <p>Sexe : {{ $user->sexe }}</p>



                        {{-- Button for Show Model, for Edit Account --}}
                        <button type="button" class="button-85 px-3 py-2 my-2 me-1" role="button" data-bs-toggle="modal"
                            data-bs-target="#modifierModale">
                            <i class="bi bi-pencil-square"></i>
                        </button>


                        {{-- Button for Download PDF --}}
                        @auth
                            @if (Auth::user()->email_verified_at != null)
                                <a href="{{ route('user.download.pdf') }}" class="  ms-1">
                                    <button type="button" class="button-85 my-2 px-3 py-2">
                                        <i class="fa-regular fa-file-pdf fa-beat" style="color: #ffffff;"></i>
                                    </button>
                                </a>
                            @endif
                        @endauth


                        {{-- Button for show modale for delete Account --}}
                        <div class="mt-4">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModale">
                                Delete Account
                            </button>
                        </div>


                        {{-- Button for Logout --}}
                        <div class="my-3">
                            <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); $('#logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </div>


                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <h6>Information</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Email</h6>
                                    <p class="text-muted">{{ $user->email }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Phone</h6>
                                    @if (isset($user->numeroTelephone))
                                        <p class="text-muted">{{ $user->numeroTelephone }}</p>
                                    @else
                                        <p class="text-muted">+212-0000-00-000</p>
                                    @endif
                                </div>
                            </div>
                            <h6>My Computers</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            @if ($computersUser->count() > 0)
                                                <button type="button" class="btn btn-dark mb-1" data-bs-toggle="modal"
                                                    data-bs-target="#addComputerModel">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                                <a href="{{ route('user.computers.index') }}" class="btn btn-dark mb-1">
                                                    <i class="bi bi-eye"></i><span class="ms-1">Show my Computers</span>
                                                </a>
                                            @endif
                                            <a href="{{ route('computers.index') }}" class="btn btn-dark mb-1">
                                                <i class="bi bi-eye-fill"></i><span class="ms-1">Show All
                                                    Computers</span>
                                            </a>

                                        </div>

                                        <div>
                                            @if ($computersUser->count() > 0)
                                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                                    data-bs-target="#DelteAllComputersModel">
                                                    Delete All Computers
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- table for show computers User --}}
                                    @if ($computersUser->count() > 0)
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Origin</th>
                                                    <th scope="col">Time of Add</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($computersUser as $computer)
                                                    <tr>
                                                        <td scope="row">{{ $computer->nameComputer }}</td>
                                                        <td>{{ $computer->originComputer }}</td>
                                                        <td><i class="text-secondary">{{ $computer->created_at }}</i></td>
                                                        <td>

                                                            {{-- btn Show --}}
                                                            <a href="{{ route('computers.show', $computer->id * 789456654987) }}"
                                                                id="show" class="m-1 btn btn-success"><i
                                                                    class="fa-regular fa-eye"></i>
                                                            </a>


                                                            {{-- btn Modify --}}
                                                            <button id="modalEditComputer{{ $loop->iteration }}"
                                                                type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal" data-bs-target="#modalEditComputer">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                            <script>
                                                                $('#modalEditComputer{{ $loop->iteration }}').click(function() {
                                                                    // document.getElementById('loadingCircl').classList.remove('d-none')
                                                                    $('#loadingCircll').removeClass('d-none')
                                                                    $('#feditPc').hide()
                                                                    $.ajax({
                                                                        type: 'get',
                                                                        url: '/user/computer/editajax/{{ $computer->id * 789456654987 }}',
                                                                        data: {
                                                                            _token: '{{ csrf_token() }}',
                                                                            id: '{{ $computer->id * 789456654987 }}'
                                                                        },
                                                                        success: function(data) {
                                                                            $('#feditPc').attr('action',
                                                                                '/user/computers/update/{{ $computer->id * 789456654987 }}')
                                                                            $('#loadingCircll').addClass('d-none')
                                                                            $('#feditPc').show()
                                                                            $('#imageComputer').html(`<label for="" class="form-label">Old
                                                                                            Image</label>
                                                                                <img src="/storage/${data.imageComputer}" alt="" class="mb-2"
                                                                                width="100%" srcset="" />`)
                                                                            $('#nameComptEdit').val(data.nameComputer)
                                                                            $('#OrigineEdit').val(data.originComputer)
                                                                            $('#PriceEdit').val(data.priceComputer)
                                                                        },
                                                                        error: function(jqXHR, textStatus, errorThrown) {
                                                                            alert(errorThrown)
                                                                        }
                                                                    });
                                                                });
                                                            </script>



                                                            {{-- Delete btn --}}
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $loop->iteration }}">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                            <!-- Modal (alert dalete) -->
                                                            <div class="modal fade"
                                                                id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="exampleModalLabel">
                                                                                ALERT</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <span class="text-danger text-bold"><strong>Are
                                                                                    you
                                                                                    sure you want to delete your
                                                                                    Computer
                                                                                    ?</strong></span>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <form
                                                                                action="{{ route('user.computers.destroy', $computer->id * 789456654987) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="m-1 btn btn-danger"
                                                                                    value="Yes">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan='4'>
                                                        <div class="d-flex justify-content-center pt-3">
                                                            <div>
                                                                {{ $computersUser->links() }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        @auth
                                            @if (Auth::user()->email_verified_at != null)
                                                <div class="alert alert-primary text-center mt-5" role="alert">
                                                    You don't have computers click <button type="button"
                                                        class="btn btn-dark p-1 py-0 mx-2" data-bs-toggle="modal"
                                                        data-bs-target="#addComputerModel">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button> if you want create your first computer
                                                </div>
                                            @else
                                                <div class="alert alert-primary text-center mt-5" role="alert">
                                                    if you want create your first computer you need to <form class="d-inline"
                                                        method="POST" action="{{ route('verification.resend') }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-link alert-link p-0 m-0 align-baseline">{{ __('Verify your email') }}</button>.
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="modifierModale" tabindex="-1" aria-labelledby="modifierModale" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modify User information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="fEditUser" action="{{ route('user.edit', ['id' => $user->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                disabled id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="Name" id="name"
                                value="{{ $user->name }}">
                            <span class="d-none text-danger">Name is invalid. It must be between 2 and 50
                                characters.</span>
                        </div>
                        <div class="mb-3">
                            <label for="Telephone" class="form-label">Numero Telephone</label>
                            <input type="text" name="Telephone" class="form-control" id="tele"
                                placeholder="+212..." value="{{ $user->numeroTelephone }}">
                            <span class="d-none text-danger">Telephone is invalid. It must start with "+212" followed by 9
                                digits.</span>
                        </div>
                        <div class="d-flex gap-3 my-2">
                            <p>Sexe : </p>
                            <div class="form-check">
                                @if (Auth::user()->sexe == 'Male')
                                    <input class="form-check-input" value="Male" checked name="sexe" type="radio"
                                        id="flexRadioDefault1">
                                @else
                                    <input class="form-check-input" value="Male" name="sexe" type="radio"
                                        id="flexRadioDefault1">
                                @endif
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                @if (Auth::user()->sexe == 'Female')
                                    <input class="form-check-input" value="Female" name="sexe" type="radio"
                                        id="flexRadioDefault2" checked>
                                @else
                                    <input class="form-check-input" value="Female" name="sexe" type="radio"
                                        id="flexRadioDefault2">
                                @endif

                                <label class="form-check-label" for="flexRadioDefault2">
                                    Female
                                </label>
                            </div>
                            <span id="msgSexeRequired" class="d-none text-danger"><strong>The Sexe field is
                                    required.</strong></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for delete account -->
    <div class="modal fade" id="deleteModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Your Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="text-danger">
                        <strong>Are you sure you want to delete your Computer ?</strong>
                    </span><br>
                    <span class="text-danger "><i>*If you delete your account all your Computers will be deleted</i></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('user.destroy', Auth::id()) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Computer -->
    <div class="modal fade" id="addComputerModel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Computer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="fAddPc" action="{{ route('user.computers.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nameCompt" class="form-label">Name Computer</label>
                            <input type="text" class="form-control" id="nameCompt" name="Name-Compt"
                                value="{{ old('Name-Compt') }}">
                            <span class="d-none text-danger">Name is invalid. It must be between 2 and 50
                                characters.</span>
                        </div>
                        <div class="mb-3">
                            <label for="Origine" class="form-label">Origine</label>
                            <input type="text" class="form-control" id="Origine" name="Origin-Compt"
                                value="{{ old('Origin-Compt') }}">
                            <span class="d-none text-danger">Origine is invalid. It must be between 2 and 50
                                characters.</span>
                        </div>
                        <div class="mb-3">
                            <label for="Price" class="form-label">Price (Dollars)</label>
                            <input type="text" class="form-control" id="Price" name="Price-Compt"
                                value="{{ old('Price-Compt') }}">
                            <span class="d-none text-danger">Pace is invalid.</span>
                        </div>

                        {{-- Upload image computer --}}
                        <label for="imagePc" class="form-label">Upload your Profile Image</label>
                        <input name="image-Compt" class="form-control form-control-lg" id="imagePc" type="file"
                            accept="image/*" value="{{ old('image-Compt') }}">
                        <span class="text-secondary">Max Size 10MB</span><br>
                        <div class="d-none text-danger" id="msgSize">Image size exceeds 10MB. Please choose a smaller
                            image.</div>
                        <div class="d-none text-danger" id="msgRequired">Image is required.</div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Computer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete all Computers -->
    <div class="modal fade" id="DelteAllComputersModel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Your Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="text-danger">
                        <strong>Are you sure you want to delete your all Computers ?</strong>
                    </span><br>
                    {{-- <span class="text-danger "><i>*If you delete your account all your Computers will be deleted</i></span> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('user.computers.destroyall', Auth::id()) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for edit profile image -->
    <div class="modal fade" id="addProfile" tabindex="-1" aria-labelledby="addProfile" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update your profile User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="fEditImgProfile" action="{{ route('user.editprofileImg', ['id' => $user->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Upload Profile Img --}}
                        <label for="image" class="form-label">Upload your Profile Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="imageUserEdit" name="image"
                                accept="image/*">
                        </div>
                        <div class="form-text" id="msg">Max Size 10MB</div>

                        <div class="d-none text-danger" id="msgRequiredEditProfile">Image is required.</div>
                        <span class="text-danger d-none mb-3" id="msgSizeEditProfile">Image size exceeds 10MB. Please
                            choose a smaller
                            image.</span>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal (alert modify computer) -->
    <div class="modal fade" id="modalEditComputer" tabindex="-1" style="min-height: 500px"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ALERT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyEditComputer">
                    <main id="loadingCircll" class="d-flex justify-content-center">
                        <svg class="sp" viewBox="0 0 128 128" style="width: 128px; height: 128px;" width="128px"
                            height="128px" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="grad1" x1="0" y1="0" x2="0"
                                    y2="1">
                                    <stop offset="0%" stop-color="#000" />
                                    <stop offset="40%" stop-color="#fff" />
                                    <stop offset="100%" stop-color="#fff" />
                                </linearGradient>
                                <linearGradient id="grad2" x1="0" y1="0" x2="0"
                                    y2="1">
                                    <stop offset="0%" stop-color="#000" />
                                    <stop offset="60%" stop-color="#000" />
                                    <stop offset="100%" stop-color="#fff" />
                                </linearGradient>
                                <mask id="mask1">
                                    <rect x="0" y="0" width="128" height="128"
                                        fill="url(#grad1)" />
                                </mask>
                                <mask id="mask2">
                                    <rect x="0" y="0" width="128" height="128"
                                        fill="url(#grad2)" />
                                </mask>
                            </defs>
                            <g fill="none" stroke-linecap="round" stroke-width="16">
                                <circle class="sp__ring" r="56" cx="64" cy="64" stroke="#ddd" />
                                <g stroke="hsl(223,90%,50%)">
                                    <path class="sp__worm1" d="M120,64c0,30.928-25.072,56-56,56S8,94.928,8,64"
                                        stroke="hsl(343,90%,50%)" stroke-dasharray="43.98 307.87" />
                                    <g transform="translate(42,42)">
                                        <g class="sp__worm2" transform="translate(-42,0)">
                                            <path class="sp__worm2-1" d="M8,22c0-7.732,6.268-14,14-14s14,6.268,14,14"
                                                stroke-dasharray="43.98 175.92" />
                                        </g>
                                    </g>
                                </g>
                                <g stroke="hsl(283,90%,50%)" mask="url(#mask1)">
                                    <path class="sp__worm1" d="M120,64c0,30.928-25.072,56-56,56S8,94.928,8,64"
                                        stroke-dasharray="43.98 307.87" />
                                    <g transform="translate(42,42)">
                                        <g class="sp__worm2" transform="translate(-42,0)">
                                            <path class="sp__worm2-1" d="M8,22c0-7.732,6.268-14,14-14s14,6.268,14,14"
                                                stroke-dasharray="43.98 175.92" />
                                        </g>
                                    </g>
                                </g>
                                <g stroke="hsl(343,90%,50%)" mask="url(#mask2)">
                                    <path class="sp__worm1" d="M120,64c0,30.928-25.072,56-56,56S8,94.928,8,64"
                                        stroke-dasharray="43.98 307.87" />
                                    <g transform="translate(42,42)">
                                        <g class="sp__worm2" transform="translate(-42,0)">
                                            <path class="sp__worm2-1" d="M8,22c0-7.732,6.268-14,14-14s14,6.268,14,14"
                                                stroke-dasharray="43.98 175.92" />
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </main>
                    <form method="get" id="feditPc" action="" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf {{-- cross site request forgery --}}
                        <div class="" id="imageComputer"></div>
                        {{-- @method('PUT') --}}
                        <div class="mb-3">
                            <label for="nameComptEdit" class="form-label">Name
                                Computer</label>
                            <input type="text" class="form-control" id="nameComptEdit" name="Name-Compt"
                                value="" />
                            <span class="d-none text-danger">Name
                                is invalid. It must be between 2 and
                                50 characters.</span>
                        </div>

                        <div class="mb-3">
                            <label for="OrigineEdit" class="form-label">Origine</label>
                            <input type="text" class="form-control" id="OrigineEdit" name="Origin-Compt"
                                value="" />
                            <span class="d-none text-danger">Origine
                                is invalid. It must be between 2 and
                                50 characters.</span>
                        </div>

                        <div class="mb-3">
                            <label for="PriceEdit" class="form-label">Price
                                (Dollars)
                            </label>
                            <input type="text" class="form-control" id="PriceEdit" name="Price-Compt"
                                value="" />
                            <span class="d-none text-danger">Pace
                                is invalid.</span>
                        </div>

                        {{-- Upload image computer --}}
                        <label for="imagePcEdit" class="form-label">Upload your Profile
                            Image</label>
                        <input name="image-Compt" class="form-control form-control-lg" id="imagePcEdit" type="file"
                            accept="image/*" value="" />
                        <span class="text-secondary">Max Size
                            10MB</span><br />
                        <div class="d-none text-danger" id="msgSizeEdit">
                            Image size exceeds 10MB. Please choose a
                            smaller image.
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
