@extends('template')

@section('title')
    {{ 'Projetos' }}
@endsection

@section('content')
    <h1>New Projetos</h1>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


        {!!  Form::open(['route'=>'projetos.store', 'method'=>'post']) !!}

        @include('Projetos._form')

        <!--- $VALUE$ Field --->
        <div class="form-group">
            {!! Form::submit('Criar Projetos', ['class' => 'btn btn-primary']) !!}
            <a href=" {{ route('projetos.index') }} " role="button" class="btn btn-success btn-large">Retornar</a>
        </div>

        {!!  Form::close() !!}


@endsection