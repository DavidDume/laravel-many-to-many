@extends('layouts.admin')

@section('content')
    

    <form method="POST" action="{{route('admin.projects.update', ['project' => $project->id])}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Add Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title', $project->title)}}">
            @error('title')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Add Link</label>
            <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link', $project->link)}}">
            @error('link')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Add Description</label>
            <input type="text" name="description" class="form-control" value="{{old('description', $project->description)}}">
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Add Type</label>
            <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror">
                <option @selected(old('type_id', $project->type_id) === "") value="">No type</option>
                @foreach ($types as $type)
                    <option @selected(old('type_id', $project->type_id) === $type->id) value="{{$type->id}}">{{$type->title}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            
            @foreach ($technologies as $tech) 
                <label for="tech_{{$tech->id}}" class="form-label">{{$tech->name}}</label>
                @if ($errors->any())
                    <input type="checkbox" id="tech_{{$tech->id}}"  @if (in_array($tech->id, old('tags', []))) checked @endif  value="{{$tech->id}}" name="technologies[]">
                @else
                <input type="checkbox" id="tech_{{$tech->id}}"  @if ($project->technologies->contains($tech->id)) checked @endif  value="{{$tech->id}}" name="technologies[]">
                @endif
            @endforeach
            @error('technologies')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>


@endsection