@extends('layout')
@section('content')
<h1>{{$project->title}}</h1>
<br>
<p>Description : {{$project->description}}</p>

<br>
<p>Task List :   </p>
<hr>

@if ($project->tasks->count())
    @foreach ($project->tasks as $task)
        <li>{{$task->description}}</li>
    @endforeach
@endif
@endsection