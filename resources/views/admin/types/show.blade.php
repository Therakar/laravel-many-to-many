@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="mt-5 mb-3">
                <h1>{{$type->name}}</h1>
                @if (count($type->projects) > 0)
                    <ul>
                        @foreach ($type->projects as $project)
                            <li class="mb-2"><a class="btn btn-success" href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></li>
                        @endforeach
                    </ul>
                @else
                    <h3>No Matches</h3>
                @endif
                
                

        </div>
        <a href="{{ route('admin.types.index')}}" class="btn btn-primary">Return to Types List</a>
    </div>
    
@endsection