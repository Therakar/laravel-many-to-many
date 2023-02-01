@extends('layouts.admin')

@section('content')
        <div class="custom-container ms-5 mt-4">
            <h1>Technologies List</h1>

            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{session('message')}}
                </div>
            @endif

            {{-- NEW type BUTTON --}}
            <a href="{{route('admin.technologies.create')}}" class="btn btn-success mt-5 mb-3"><i class="fa-solid fa-plus md-1"></i> New Technology</a>
        </div>
        

        <div class="custom-container d-flex flex-wrap">
        
            @foreach ($technologies as $technology)
                <div class="card col-4 ms-5 mb-5 d-flex" style="width: 20%;">
                    <div>
                        @if ($technology->cover_image)
                            <img class="card-img-top" src="{{asset('storage/' . $technology->cover_image)}}" alt="{{$technology->title}}"> 
                            {{-- oppure <img src="{{asset("storage/$technology->cover_image")}}" alt="{{$technology->title}}">  --}}
                        @else
                            <img class="card-img-top" src="{{ Vite::asset('resources/img/placeholder.png') }}" alt="{{$technology->title}}">
                        @endif
                    </div>
                <div class="card-body">
                    
                    <h5 class="card-title">{{$technology->title}}</h5>
                    
                    <p class="card-text"><strong>Id:</strong> {{$technology->id}}</p>
                    <p class="card-text"><strong>Name:</strong> {{$technology->name}}</p>
                    <p class="card-text"><strong>Slug:</strong> {{$technology->slug}}</p>

                    {{-- BUTTONS --}}
                    <div>
                        <a href="{{ route('admin.technologies.show', $technology->slug) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a> {{-- uso $technology->slug al posto di $technology->id in modo da usare lo slug al posto dell'id --}}
                        <a href="{{route('admin.technologies.edit', $technology->slug)}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                        
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$technology->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{$technology->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">To be sure</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete the technology "{{$technology->name}}" ?
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.technologies.destroy', $technology->slug)}}" class="d-inline-block" method="POST">
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
