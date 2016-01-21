@extends('template')

@section('title')
    {{ 'Projetos' }}
@endsection

@section('content')
    <h1>Edit Aplicação</h1>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



        {!!  Form::model($aplicacoes, ['route'=>['aplicacoes.update', $aplicacoes->id], 'method'=>'put']) !!}

        @include('Aplicacoes._form')

        <!--- $VALUE$ Field --->
        <div class="form-group">
            {!! Form::submit('Salvar Aplicacoes', ['class' => 'btn btn-primary']) !!}
            <a href=" {{ route('aplicacoes.index') }} " role="button" class="btn btn-success btn-large">Retornar</a>
        </div>

        {!!  Form::close() !!}


@endsection