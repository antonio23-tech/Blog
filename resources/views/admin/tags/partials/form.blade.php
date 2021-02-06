<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingresa el nombre de la etiqueat']) !!}

    @error('name')
        <small class="text-danger">{{$message}}</small>
    @enderror
    </div>

    <div class="form-group">
    {!! Form::label('slug','Slug') !!}
    {!! Form::text('slug',null, ['class'=>'form-control','placeholder'=>'Ingresa el nombre del slug','readonly']) !!}

    @error('slug')
        <small class="text-danger">{{$message}}</small>
    @enderror
    </div>

    <div class="form-group">
        {{-- <label for="color">Color:</label>

        <select class="form-control" name="color" id="">
            <option value="red">Color rojo</option>
            <option value="green">Color verde</option>
            <option value="blue" selected>Color azul</option>
        </select> --}}

        {!! Form::label('color','Color') !!}
        {!! Form::select('color', $colors, null, ['class'=>'form-control']) !!}

        @error('color')
        <small class="text-danger">{{$message}}</small>
    @enderror
    </div>
