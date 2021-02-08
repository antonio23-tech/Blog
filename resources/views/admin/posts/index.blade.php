@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
      <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.posts.create')}}">Crear nuevo post</a>
      <h1>Listado de posts</h1>
  @livewire('admin.posts-index')

@stop

@section('content')

@stop

