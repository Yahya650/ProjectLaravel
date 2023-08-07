@extends('layouts.app')
@section('title',"Create Computer")

@section('content')
    
    <h1 class="mb-3">Create Computer</h1>
    <form id="f" method="POST" action="{{route("computers.store")}}" enctype="multipart/form-data">
        @csrf {{-- cross site request forgery --}}

        <div class="mb-3">
            <label for="nameCompt" class="form-label">Name Computer</label>
            <input type="text" class="form-control" id="nameCompt" name="Name-Compt" value="{{old('Name-Compt')}}">
            @error('Name-Compt')
                <div class="alert alert-danger mt-2 p-2" role="alert">
                    {{$message}}
                </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="Origine" class="form-label">Origine</label>
                <input type="text" class="form-control" id="Origine" name="Origin-Compt" value="{{old('Origin-Compt')}}">
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
            <label for="Price" class="form-label">Price (Dollars)</label>
            <input type="text" class="form-control" id="Price" name="Price-Compt" value="{{old('Price-Compt')}}">
            @error('Price-Compt')
                <div class="alert alert-danger mt-2 p-2" role="alert">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image ( jpg, jpeg, png, bmp, gif, svg, webp )</label>
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