@extends('layouts.admin')

@section('content')
    
<a href="{{route('admin.projects.create')}}" class="btn btn-primary">Add a new project</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Link</th>
            <th scope="col">Type</th>
            <th scope="col">Tech</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($projects as $project)
        <tr>
            <th scope="row">{{$project->project}}</th>
            <td>{{$project->title}}</td>
            <td>{{$project->link}}</td>
            <td>{{(!$project->type) ? 'No Type' : $project->type->title}}</td>
            <td>@foreach ($project->technologies as $tech)
                    <span>{{$tech->name}}</span>
                @endforeach
            </td>
            <td>
                <a type="button" class="btn btn-primary" href="{{route('admin.projects.show', ['project' => $project->id])}}">Show</a>
                <a type="button" class="btn btn-warning" href="{{route('admin.projects.edit', ['project' => $project->id])}}">Edit</a>
                <form action="{{route('admin.projects.destroy', ['project' => $project->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>


@endsection