@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')

    <h1>Crear nuevo Posts</h1>
@stop

@section('content')
     <div class="card">
         <div class="card-body">
             {!! Form::open(['route'=>'admin.posts.store','autocomplete'=>'off','files'=>true]) !!}
            
             {!! Form::hidden('user_id', auth()->user()->id) !!}

             <div class="form-group">
                 {!! Form::label('name', 'Nombre') !!}
                 {!! Form::text('name',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del post']) !!}

                 @error('name')
                 <span class="text-danger">{{$message}}</span>   
                 @enderror
             </div>

             <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del slug', 'readonly']) !!}

                @error('slug')
                 <span class="text-danger">{{$message}}</span>   
                 @enderror
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Categoria') !!}
                {!! Form::select('category_id',$categories, null, ['class'=>'form-control']) !!}

                @error('category_id')
                 <span class="text-danger">{{$message}}</span>   
                 @enderror
            </div>

            <div class="form-group">
                <p class="font-weight-bold">Etiquetas</p>
                @foreach ($tags as $tag)
                  
            <label class="mr-2">
                {!! Form::checkbox('tags[]', $tag->id, null,) !!}
                {{$tag->name}}
            </label>
                @endforeach
               
                @error('tags')
                <br>
                <span class="text-danger">{{$message}}</span>   
                @enderror
            </div>

            <div class="form-group">
                <p class="font-weight-bold">Estado</p>
               <label>
                {!! Form::radio('status', 1, true) !!}
                Borrador
               </label>

               <label>
                {!! Form::radio('status', 2) !!}
                Publicado
               </label>
               
               @error('status')
               <br>
                <span class="text-danger">{{$message}}</span>   
                @enderror

            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <div class='image-wrapper'>
                    <img id="picture" src="https://cdn.pixabay.com/photo/2015/12/04/14/05/code-1076536_960_720.jpg" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('file', 'Ingrese la imagen para el post') !!}
                        {!! Form::file('file', ['class'=>'form-control-file','accept'=>'image/*']) !!}
                        @error('file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat amet tenetur quod sapiente praesentium reprehenderit. Eaque rem maxime ducimus nesciunt dignissimos velit. Illum eum dolorum veritatis sit quo suscipit similique.</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('extract','Extracto') !!}
                {!! Form::textarea('extract', null, ['class'=>'form-control']) !!}

                @error('extract')
                <span class="text-danger">{{$message}}</span>   
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('body','Cuerpo del post') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}

                @error('body')
                <span class="text-danger">{{$message}}</span>   
                @enderror
            </div>

            {!! Form::submit('Agregar Post', ['class'=>'btn btn-primary']) !!}

             {!! Form::close() !!}
         </div>
     </div>
@stop

@section('css')
    <style>
      .image-wrapper{
          position: relative;
          padding-bottom: 56.25%;
      }

      .image-wrapper img{
          position:absolute;
          object-fit: cover;
          width: 100%;
          height: 100%;
      }
    </style>
    
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

        <script>
            // validacion del slug
        $(document).ready( function() {
            $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
            });
        });

        // ck editor
        ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

        //Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result); 
            };

            reader.readAsDataURL(file);
        }
        </script>
@stop

