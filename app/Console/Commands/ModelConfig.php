<?php
/*
 * Por: Paulo Vaz
 * php artisan sc_config:projeto "NomeDoProjeto""
 *
 * Este script gera os Models a partir da base de dados criada, vc passa o nome do projeto e ele retorna o nome do bando
 * Verifique e a pasta Model existe em app
 *
 * Falta Terminar:
 * Validar se o diretório esiste do projeto
 * Validar se algum model já existe, se existir perguntar se que substituir ou criar uma cópia
 *
 * Atualizado 18-10-2015
 */
namespace SCSerbinario\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SCSerbinario\Models\Projetos;
use SCSerbinario\Util\Generic;
use SCSerbinario\Util\Tables;
use Illuminate\Filesystem\Filesystem;

class ModelConfig extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:create { projetName }  ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera os model a partir do banco';

    private $projectName;

    /*
     * db e o nome que se encontra o arquivo app/config/datatable.php, que se referencia a segunda conexao com o banco
     */

    private $projetos;

    private $tableDescribes;

    private $tableFields;

    private $compileRelations = "";

    private $project;

    /*
     * Nome do arquivo modelo
     */
    private $pathFileModel = "app/Util/Stubs/model.stub";

    private $pathFile = "/app/Models/";

    private $nameClasseSingular;

    //Vai ignorar esse campos da tabela
    private $ignore = array('id','created_at','updated_at');
    /**
     * @var Filesystem
     */
    private $files;
    /**
     * @var Composer
     */
    private $composer;

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
            if ($this->confirm("Voce gostaria de criar o Model  $value->table_name ? [y|N]")) {

                //Passo cada tabela e retorno todos os campos
                $this->tableDescribes = Tables::getTableDescribes($value->table_name);

                //Comcateno em tableField todos os campos da tabela
                $this->tableFields .= "[ " .PHP_EOL;
                foreach ($this->tableDescribes as $values) {

                    if (!in_array($values->Field, $this->ignore)) {

                        $this->tableFields .= "\t\t'" . $values->Field . "'," . "\n";
                    }
                }

                $this->tableFields .= "\t]";



                //Retorna todos os relacionamentos da tabela
                $foreign = Tables::getForeigns($value->table_name);

                $this->getForeigns($foreign);

                Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
                Generic::setReplacements(['TABLE' => $value->table_name]);
                Generic::setReplacements(['CLASS' => Tables::ucWords($value->table_name)]);
                Generic::setReplacements(['FILLABLE' => $this->tableFields]);
                Generic::setReplacements(['METODO' => $this->compileRelations]);


                Tables::write(Generic::getContents(Generic::getReplacements()));

                Generic::clearReplacements();

                $this->compileRelations = "";
                $this->tableFields = "";
            }
        }
    }

    public function getForeigns($foreign)
    {
        foreach ($foreign as $k => $v) {

            if ($this->confirm("Foi encontrado um relacionamento com a tablea  => $v->REFERENCED_TABLE_NAME , voce gostaria de criar? [y|N]")) {
                $nome_classe = $this->ask('Qual nome do Método?');
                $this->compileRelations .= Tables::compileRelations($v, $nome_classe, $this->project->name_space_projeto);
            }
        }
    }


}
