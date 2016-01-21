<?php

namespace SCSerbinario\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SCSerbinario\Models\Projetos;
use SCSerbinario\Util\Generic;
use SCSerbinario\Util\Tables;
use Illuminate\Filesystem\Filesystem;

class RequestConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:create { projetName }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';
    /**
     * @var Projetos
     */
    private $projetos;
    /**
     * @var Filesystem
     */
    private $files;

    private $project;

    private $pathFileModel = "app/Util/Stubs/request.stub";

    private $pathFile = "/app/Http/Requests/";

    private $tableFields;
    private $tableDescribes;

    //Vai ignorar esse campos da tabela
    private $ignore = array('id','created_at','updated_at');

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Projetos $projetos, Filesystem $files)
    {
        parent::__construct();
        $this->projetos = $projetos;
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$projectName = $this->argument('projetName')) {
            $this->info("O Nome do projeto é obrigatorio");
            exit();
        }

        //Retorna o objeto
        $this->project = DB::table('projetos')->where('nome_projeto', $projectName)->first();
        if(!$this->project){
            $this->info("O Nome do projeto é obrigatorio");
            exit();
        }

        if($this->project->nome_db_projeto == "")
        {
            $this->info("O Nome do base de dados não foi setada no projeto");
            exit();
        }

        //Seto a base de dados
        Tables::setDatabase($this->project->nome_db_projeto);

        //Seto o caminho do projeto
        Tables::setDirProject($this->project->path_projeto_projeto);

        //Seto o caminho onde o arquivo sera gravado
        Tables::setPathFile($this->pathFile);

        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->pathFileModel);

        if(! $tables = Tables::getTables())
        {
            $this->info("Não há tabelas para ser processado");
            exit();
        }


        foreach ($tables as  $value)
        {
            if ($this->confirm("Voce gostaria de criar o Request  $value->table_name ? [y|N]")) {

                //Passo cada tabela e retorno todos os campos
                $this->tableDescribes = Tables::getTableDescribes($value->table_name);

                //Comcateno em tableField todos os campos da tabela
                $this->tableFields .= "[ " .PHP_EOL;
                foreach ($this->tableDescribes as $values) {

                    if (!in_array($values->Field, $this->ignore)) {

                        $this->tableFields .= "\t\t\t'" . $values->Field . "'" . " => ''," . "\n";
                    }
                }

                $this->tableFields .= "\t\t];";
                //dd($this->tableFields);
                //Retorna todos os relacionamentos da tabela
                $foreign = Tables::getForeigns($value->table_name);

                //$this->getForeigns($foreign);

                Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
                Generic::setReplacements(['CLASS' => Tables::ucWords($value->table_name .  "_Request")]);
                Generic::setReplacements(['RULES' => $this->tableFields]);


                Tables::write(Generic::getContents(Generic::getReplacements()));

                Generic::clearReplacements();

                $this->compileRelations = "";
                $this->tableFields = "";
            }
        }

    }

}
