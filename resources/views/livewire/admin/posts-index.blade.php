<div class="card">
    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de un post" type="text">

        {{-- validacion de que exista algun post --}}
        @if ($posts->count())
              
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->name}}</td>
                    <td with="10px">
                        <a class="btn btn-primary btn-sm" href="{{route('admin.posts.edit',$post)}}">Editar</a>
                    </td>
                    <td with="10px">
                         <form action="{{route('admin.posts.destroy',$post)}}" method="POST">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                         </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>

    {{-- paginacion --}}
   <div class="card-footer">
       {{$posts->links()}}

   </div>
     
      @else
      <div class="card-body">
      <strong>No hay regirtos de posts con ese nombre</strong>
      </div>           
      @endif

</div>
