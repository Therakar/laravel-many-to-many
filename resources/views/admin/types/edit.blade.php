@extends('layouts.admin')

@section('content')

    <div class="container mt-5">
        <h1>Modify: {{$type->name}}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div> 
        @endif 
        <form action="{{route('admin.types.update', $type)}}" method="POST" class="mb-5">
        @csrf
        @method('PUT')
            <div class="mb-3 w-25">
               <label for="name" class="form-label">Name*</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Insert the type's name" value="{{old('name')}}">
            </div>
            <button type="submit" class="btn btn-success">Confirm</button>
        </form>

        <div>
            <a href="{{ route('admin.types.index')}}" class="btn btn-primary">Return to Types List</a>
        </div>
        
    </div>
    
@endsection