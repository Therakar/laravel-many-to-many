@extends('layouts.admin')

@section('content')
        <div class="custom-container ms-5 mt-4">
            <h1>Types List</h1>

            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{session('message')}}
                </div>
            @endif

            {{-- NEW type BUTTON --}}
            <a href="{{route('admin.types.create')}}" class="btn btn-success mt-5 mb-3"><i class="fa-solid fa-plus md-1"></i> New Type</a>
        </div>
        

        <div class="custom-container d-flex flex-wrap">
        
            @foreach ($types as $type)
                <div class="card col-4 ms-5 mb-5 d-flex" style="width: 20%;">
                    <div>
                        @if ($type->cover_image)
                            <img class="card-img-top" src="{{asset('storage/' . $type->cover_image)}}" alt="{{$type->title}}"> 
                            {{-- oppure <img src="{{asset("storage/$type->cover_image")}}" alt="{{$type->title}}">  --}}
                        @else
                            <img class="card-img-top" src="{{ Vite::asset('resources/img/placeholder.png') }}" alt="{{$type->title}}">
                        @endif
                    </div>
                <div class="card-body">
                    
                    <h5 class="card-title">{{$type->title}}</h5>
                    
                    <p class="card-text"><strong>Id:</strong> {{$type->id}}</p>
                    <p class="card-text"><strong>Name:</strong> {{$type->name}}</p>
                    <p class="card-text"><strong>Slug:</strong> {{$type->slug}}</p>

                    {{-- BUTTONS --}}
                    <div>
                        <a href="{{ route('admin.types.show', $type->slug) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a> {{-- uso $type->slug al posto di $type->id in modo da usare lo slug al posto dell'id --}}
                        <a href="{{route('admin.types.edit', $type->slug)}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                        
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$type->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{$type->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete the type "{{$type->name}}" ?
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.types.destroy', $type->slug)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                     <button type="submit" class="btn btn-danger">Confirm</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nope</button>
                               
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            
        @endforeach
        </div>
@endsection
