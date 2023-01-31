@extends('layouts.admin')

@section('content')
        <div class="custom-container ms-5 mt-4">
            <h1>Projects List</h1>

            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{session('message')}}
                </div>
            @endif

            {{-- NEW PROJECT BUTTON --}}
            <a href="{{route('admin.projects.create')}}" class="btn btn-success mt-5 mb-3"><i class="fa-solid fa-plus md-1"></i> New Project</a>
        </div>
        

        <div class="custom-container d-flex flex-wrap">
        
            @foreach ($projects as $project)
                <div class="card col-4 ms-5 mb-5 d-flex" style="width: 20%;">
                    <div>
                        @if ($project->cover_image)
                            <img class="card-img-top" src="{{asset('storage/' . $project->cover_image)}}" alt="{{$project->title}}"> 
                            {{-- oppure <img src="{{asset("storage/$project->cover_image")}}" alt="{{$project->title}}">  --}}
                        @else
                            <img class="card-img-top" src="{{ Vite::asset('resources/img/placeholder.png') }}" alt="{{$project->title}}">
                        @endif
                    </div>
                <div class="card-body">
                    
                    <h5 class="card-title">{{$project->title}}</h5>
                    
                    <p class="card-text"><strong>Customer:</strong> {{$project->customer}}</p>
                    <p class="card-text"><strong>Version:</strong> v{{$project->version}}</p>
                    <p class="card-text"><strong>Type:</strong> {{$project->type?->name ?: 'No Type'}}</p>

                    {{-- BUTTONS --}}
                    <div>
                        <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a> {{-- uso $project->slug al posto di $project->id in modo da usare lo slug al posto dell'id --}}
                        <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                        
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$project->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{$project->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete the project "{{$project->title}}" ?
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('admin.projects.destroy', $project->slug)}}" class="d-inline-block" method="POST">
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

{{-- <div class="card">
    <img src="..." class="card-img-top" alt="...">
  
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div> --}}