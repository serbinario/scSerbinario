@extends('template')

@section('title')
    {{ 'Projetos' }}
@endsection



@section('content')

    <a href=" {{ route('projetos.create') }} " role="button" class="btn btn-success btn-large">Novo Projeto</a>
    <br>
    <br>
    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Projeto</th>
            <th>Descrição</th>
            <th>NameSpace</th>
            <th>Nome DB</th>
            <th>Path</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        @foreach($projetos as $projeto)
            <?php //dd($projeto)?>
            <tr>
                <td>{{ $projeto->id }}</td>
                <td>{{ $projeto->nome_projeto }}</td>
                <td>{{ $projeto->descricao_projeto }}</td>
                <td>{{ $projeto->name_space_projeto }}</td>
                <td>{{ $projeto->nome_db_projeto }}</td>
                <td>{{ $projeto->path_projeto_projeto }}</td>
                <td><a href=" {{ route('projetos.edit', $projeto->id ) }} ">Editar</a></td>
                <td><a href=" {{ route('projetos.destroy', $projeto->id ) }} ">Deletar</a></td>
            </tr>
        @endforeach
    </table>

@endsection