@extends('layouts.admin')

@section('content')

    <div class="container mt-5">
        <h1>Create a New Project</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div> 
        @endif 
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data" class="mb-5"> {{-- se non usassi l'enctype mi verrebbe restituito solo il nome dell'immagine --}}
        @csrf
            <div class="mb-3">
               <label for="title" class="form-label">Title*</label>
               <input type="text" class="form-control" id="title" name="title" placeholder="Insert the project's title" value="{{old('title')}}">
            </div>
            <div class="mb-3">
                <label for="customer" class="form-label">Customer*</label>
                <input type="text" class="form-control" id="customer" name="customer" placeholder="Who's the costumer?" value="{{old('customer')}}">
            </div>
            <div class="mb-3">
                <label for="version" class="form-label">Version*</label>
                <input type="text" class="form-control" id="version" name="version" placeholder="What's your project version?" value="{{old('version')}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description*</label>
                <textarea class="form-control" id="description" name="description" rows="10" placeholder="Describe your project...">{{old('title')}}</textarea>
            </div>
            <div class="mb-3 w-25">
                <label for="cover_image" class="form-label">Cover image</label>

                {{-- image preview --}}
                <div>
                    <img id="output" width="100" class="mb-2"/>
                    <script>
                        var loadFile = function(event) {
                            var reader = new FileReader();
                            reader.onload = function(){
                            var output = document.getElementById('output');
                            output.src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        };
                    </script>
                </div>
                
                <input type="file" class="form-control" id="cover_image" name="cover_image" value="{{old('cover_image')}}" onchange="loadFile(event)">
            </div>
            <div class="mb-3 w-25">
                <label for="type_id" class="form-label">Type</label>
                <select name="type_id" id="type_id" class="form-select">
                    <option value="">No Type</option>
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" {{ old('type_id') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Confirm</button>
        </form>

        <div>
            <a href="{{ route('admin.projects.index')}}" class="btn btn-primary">Return to Projects List</a>
        </div>
        
    </div>
    
@endsection