   <!--- $VALUE$ Field --->

<div class="form-group">
    {!! Form::label('Categogy', 'Nome Projeto:') !!}
    {!! Form::select ('projetos_id', $projetos, null, ['class' => 'form-control', 'readonly'=>'readonly']) !!}
</div>

<div class="form-group">
    {!! Form::label('nome_aplicacao', 'Nome da Aplicação:') !!}
    {!! Form::text('nome_aplicacao', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('table_name_aplicacao', 'Nome da Tabela:') !!}
    {!! Form::text('table_name_aplicacao', null, ['class' => 'form-control']) !!}
</div>

