   <!--- $VALUE$ Field --->
        <div class="form-group">
            {!! Form::label('nome_projeto', 'Nome do Projeto:') !!}
            {!! Form::text('nome_projeto',  null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_space_projeto', 'Nome da NameSpace:') !!}
            {!! Form::text('name_space_projeto', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('nome_db_projeto', 'Nome do Banco:') !!}
            {!! Form::text('nome_db_projeto', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao_projeto', 'Descrição:') !!}
            {!! Form::textarea('descricao_projeto', null, ['class' => 'form-control']) !!}
        </div>