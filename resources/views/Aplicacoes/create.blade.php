@extends('template')

@section('title')
    {{ 'Projetos' }}
@endsection

@section('content')
    <h1>Nova Aplicacao</h1>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


        {!!  Form::open(['route'=>'aplicacoes.store', 'method'=>'post']) !!}

        @include('Aplicacoes._form')

        <!--- $VALUE$ Field --->
        <div class="form-group">
            {!! Form::submit('Criar Aplicação', ['class' => 'btn btn-primary']) !!}
            <a href=" {{ route('aplicacoes.index') }} " role="button" class="btn btn-success btn-large">Retornar</a>
        </div>

        {!!  Form::close() !!}


@endsection