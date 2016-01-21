
@extends('template')

@section('title')
    {{ 'Aplicações' }}
@endsection



@section('content')

    <a href=" {{ route('aplicacoes.create') }} " role="button" class="btn btn-success btn-large">Nova Aplicação</a>
    <br>
    <br>
    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Aplicação</th>
            <th>Projeto</th>
            <th>Nome Tabela</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        @foreach($aplicacoes as $aplicacao)
            <?php //dd($aplicacoes)?>
            <tr>
                <td>{{ $aplicacao->id }}</td>
                <td>{{ $aplicacao->nome_aplicacao }}</td>
                <td>{{ $aplicacao->Projetos->nome_projeto }}</td>
                <td>{{ $aplicacao->table_name_aplicacao }}</td>
                <td><a href=" {{ route('aplicacoes.edit', $aplicacao->id ) }} ">Editar</a></td>
                <td><a href=" {{ route('aplicacoes.destroy', $aplicacao->id ) }} ">Deletar</a></td>

            </tr>
        @endforeach




    </table>

@endsection