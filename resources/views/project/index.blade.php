@extends('layout')
@section('content')

<h1>Welcome To Web Laravel</h1>
<p>Jumlah Project Yang telah dibuat : 
        @if ($catch == true)
    {{ $project->count()  }}
        @else
        0
    @endif 
</p>
<button type="button" data-toggle="modal" data-target="#create" class="btn btn-primary">Create A Project</button>

<br>
<br>
@if ($catch == true)
    @foreach ($project as $i => $projek)
        <ul>
        <h3>{{$i+1}} - {{$projek->title}} </h3>
            <li class="col-sm-3">{{$projek->description}}</li>
            <br>
            {{-- <a class="btn btn-sm btn-success" href="{{ route('project.edit',$projek->slug) }}">Edit</a> --}}
            <button type="button" class="btn btn-m btn-success col-sm-1" data-toggle="modal" data-target="#edit_{{$projek->slug}}">Edit</button>
            <button type="button" class="btn btn-danger col-sm-1" data-toggle="modal" data-target="#delete_{{$projek->slug}}">Delete</button>
            <a class="btn btn-primary col-sm-1" href="{{ route('project.show',$projek->slug) }}">List Task</a>
            <hr>
        </ul>   

        
{{-- start modal edit  --}}
<div class="modal fade" id="edit_{{$projek->slug}}" tabindex="-1" role="dialog" aria-labelledby="edit1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="edit1">Edit A Project</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="/project/{{$projek->slug}}">
                        @csrf
                        @method('PUT')
                        <br>
                        <div class="form-group mb-3">
                            <label for="title">Judul Projek</label>
                            <input id="title" type="text" name="title" value="{{$projek->title}}" placeholder="Title Project" class="form-control ">
                        </div>
                    <br>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi Projek</label>
                            <textarea id="deskripsi" class="form-control" name="description" cols="30" rows="10" placeholder="Description About Project">{{$projek->description}}</textarea>
                        </div>    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Edit A Project</button>
                    </form>          
            </div>
          </div>
        </div>
      </div>
        {{-- end modal edit --}}
        <!-- Modal -->
    <div class="modal fade" id="delete_{{$projek->slug}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Are You Sure Want To Delete ?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are You Sure Want To Delete Project {{$projek->title}} 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <form method="POST" action="/project/{{ $projek->slug }}">
                    @method('DELETE')
                    @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>          
                  </form>
                </div>
              </div>
            </div>
          </div>

    @endforeach

    
@else
    <h3>Data Not Found!.</h3>
@endif


<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create A Project</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="/project">
                        @csrf
                        <br>
                        <div class="input-group mb-3 ">
                            <input type="text" name="title" placeholder="Title Project" class="form-control ">
                        </div>
                    <br>
                        <div class="input-group mb-3">
                            <textarea class="form-control" name="description" cols="30" rows="10" placeholder="Description About Project"></textarea>
                        </div>    
                            <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Create A Project</button>
                    </form>          
            </div>
          </div>
        </div>
      </div>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
  @if ($errors->any())
  @foreach ($errors->all() as $eror)
     <script>
        
        swal({
    title: "Oh No...",
    text: " {!! $eror !!} ",
    icon: "error",
    button: "Coba Lagi",
    });     
        </script>
  @endforeach
     @endif

    @if ($message = Session::get('successdel'))
        <script>
            swal("Sukses!", "{!!$message!!}", "success");
        </script>
    @endif

    @if ($message = Session::get('successcreate'))
        <script>
            swal("Sukses Terbuat!", "{!!$message!!}", "success");
        </script>
    @endif

    @if ($message = Session::get('successupdate'))
        <script>
            swal("Sukses Update!", "{!!$message!!}", "success");
        </script>
    @endif


    
@endsection