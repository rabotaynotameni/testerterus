@extends('layout')
@section('content')
<h1>{{$project->title}}</h1>
<br>
<p>Description : {{$project->description}}</p>

<br>
<p>Task List :  <button type="button" data-toggle="modal" data-target="#createTask" class="btn btn-primary ">Create Task</button> </p>
<hr>

@if ($project->tasks->count())

<div class="card">
        <div class="card-body">
                {{-- Start Table --}}
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    <th scope="col">Created At </th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                
                    @foreach ($project->tasks as $i=>$task)
                    <tr>
                        <th scope="row">{{$i+1}}</th>
                        <td>{{$task->description}}</td>
                        <td>{{$task->created_at}}</td>
                        <td><button type="button" class="btn btn-danger" data-target="#DeleteTask_{{$task->id}}" data-toggle="modal">Delete Task</button></td>
                    </tr>




                    
{{-- Modal Delete Start --}}

    <div class="modal fade" id="DeleteTask_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="DeleteTask" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="DeleteTask">Delete A Task</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                        <form method="POST" action="/task/{{$task->id}}">
                            @method('DELETE')
                            @csrf
    
                        Are You Sure delete Task : {{$task->description}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Delete Task</button>
                        </form>          
                </div>
              </div>
            </div>
          </div>    
    {{-- End Modal Delete --}}
                    @endforeach
  
                </tbody>
            </table>
            {{-- End Table --}}
        </div>
</div>
@else
    <h4>Ups! Ga ada task nih, bisa dibuat ya :)</h4>
@endif

<br>
<a href="/project" class="btn-lg btn btn-outline-primary col-md-2">Balik</a>

{{-- Modal Create Start --}}

<div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="createTask" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createTask">Create A Task</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="/task/{{$project->slug}}">
                        @csrf
                        <br>
                        <div class="input-group mb-3 ">
                            <input type="text" name="description" placeholder="Description Task" class="form-control ">
                        </div>  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Create A Task</button>
                    </form>          
            </div>
          </div>
        </div>
      </div>    
{{-- End Modal Create --}}





{{-- @if ($message = Session::get('successTask'))
        <script>
            swal("Sukses!", "{!!$message!!}", "success");
        </script>
@endif --}}

@endsection


