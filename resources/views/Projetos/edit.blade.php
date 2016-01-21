@extends('template')

@section('title')
    {{ 'Projetos' }}
@endsection

@section('content')
    <h1>Edit Projetos</h1>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


        {!!  Form::model($projetos, ['route'=>['projetos.update', $projetos->id], 'method'=>'put']) !!}

        @include('Projetos._form')

        <!--- $VALUE$ Field --->
        <div class="form-group">
            {!! Form::submit('Salvar Projetos', ['class' => 'btn btn-primary']) !!}
            <a href=" {{ route('projetos.index') }} " role="button" class="btn btn-success btn-large">Retornar</a>
        </div>

        {!!  Form::close() !!}


@endsection