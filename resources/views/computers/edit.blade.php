@extends('layouts.app')
@section('title',"Update Computer")
@section('bg_color','white')


@section('content')
    <h1 class="mb-3">Update Computer</h1>
    <form id="f" method="post" action="{{route("user.computers.update",$Computer->id*789456654987)}}" enctype="multipart/form-data">
        <div class="" id="image" >
            <label for="" class="form-label">Old Image</label>
            <img src="{{Storage::url($Computer['imageComputer'])}}" alt="" class="mb-2" width="100%" srcset="">
        </div>
        @csrf {{-- cross site request forgery --}}
        @method('PUT')
        <div class="mb-3">
            <label for="nameCompt" class="form-label">Name Computer</label>
            <input type="text" class="form-control" id="nameCompt" name="Name-Compt" value="{{$Computer['nameComputer']}}">
            @error('Name-Compt')
                <div class="alert alert-danger mt-2 p-2" role="alert">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="desc" class="form-label">Descreption de Computer <i class="blockquote-footer">(Optionnel)</i></label>
            <textarea type="text" class="form-control" id="desc" name="desc">{{ $Computer['desc'] }}</textarea>
            @error('desc')
                <div class="alert alert-danger mt-2 p-2" role="alert">
                    {{$message}}
                </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="Origine" class="form-label">Origine</label>
                <input type="text" class="form-control" id="Origine" name="Origin-Compt" value="{{$Computer['originComputer']}}">
                <div>
                    @error('Origin-Compt')
                        <div class="alert alert-danger mt-2 p-2" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label for="Price" class="form-label">Price</label>
            <input type="text" class="form-control" id="Price" name="Price-Compt" value="{{$Computer['priceComputer']}}">
            @error('Price-Compt')
                <div class="alert alert-danger mt-2 p-2" role="alert">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">New Image (jpg,jpeg,png,bmp,gif,svg,webp)</label>
            <input name="image-Compt" class="form-control form-control-lg" id="image" type="file" value="{{old('image-Compt')}}">
            <span class="text-secondary">Max Size 10MB</span>
            @error('image-Compt')
                <div class="alert alert-danger mt-2 p-2" role="alert">
                    {{$message}}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
@endsection