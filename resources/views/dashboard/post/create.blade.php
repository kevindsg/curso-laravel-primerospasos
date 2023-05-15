@extends('dashboard.layout')


@section('page1')

<h1>Crear Post</h1>

@include('dashboard.fragment._errors-form')


    <form action="{{route('post.store')}}" method="post">
        
        @include('dashboard.post._form')
        
    </form> 
@endsection