<?php

namespace SCSerbinario\Console\Commands\Symfony;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SCSerbinario\Models\Projetos;
use SCSerbinario\Util\Generic;
use SCSerbinario\Util\Tables;
use Illuminate\Filesystem\Filesystem;

/*
 * Por Paulo Vaz
 * 1 - Crie a entidade para cada tabela, coloque no projeto só as tabelas que será necessário fazer o crud
 * 2 - Antes de executar o script, sertifique-se que já criou os diretórios DAO, RN, Entity e Form
 * 3 - Já deverá existir as interfaces: interfaceDAO.php e TraitDAO.php
 *
 */

class CrudBasicoSymfony extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudSym:create {projectName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar um crud do symfony2.';
    /**
     * @var Filesystem
     */
    private $files;

    /**
     * @var Filesystem
     */
    private $bundleName;

    /**
     * @var Filesystem
     * Nome da variável que tem o caminho o bundle
     */
    private $pathBundleName;

    /**
     * @var Filesystem
     * Nome da variável que tem o caminho o arquivo interfaceEntityDAO.php
     */
    private $pathFileInterfaceEntityDAO = "app/Util/Stubs/interfaceEntityDAO.stub";

    /**
     * @var Filesystem
     * Nome da variável que tem o caminho o arquivo EntityDAO.php
     */
    private $pathFileEntityDAO = "app/Util/Stubs/EntityDAO.stub";

    /**
     * @var Filesystem
     * Nome da variável que tem o caminho o arquivo EntityRN.php
     */
    private $pathFileEntityRN = "app/Util/Stubs/EntityRN.stub";

    /**
     * @var Filesystem
     * Nome da variável que tem o caminho o arquivo EntityRN.php
     */
    private $pathFileEntityType = "app/Util/Stubs/EntityType.stub";

    /**
     * @var Filesystem
     * Nome da variável que tem o caminho o arquivo EntityRN.php
     */
    private $pathFileEntityController = "app/Util/Stubs/EntityController.stub";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$projectName = $this->argument('projectName')) {
            $this->info("O Nome do projeto é obrigatorio");
            exit();
        }

        //Retorna o objeto
        $this->project = DB::table('projetos')->where('nome_projeto', $projectName)->first();
        if(!$this->project){
            $this->info("Projeto não encontrado");
            exit();
        }

        if($this->project->nome_db_projeto == "")
        {
            $this->info("O Nome do base de dados não foi setado no projeto");
            exit();
        }

        if($this->project->bundle == "")
        {
            $this->info("O Nome do Blunde não foi setado no projeto");
            exit();
        }

        if($this->project->name_space_projeto == "")
        {
            $this->info("O Nome da NameSpace não foi setado no projeto");
            exit();
        }

        $this->pathBundleName =
            "../"
            . $this->project->path_projeto_projeto . "/"
            . "src" . "/"
            . $this->project->name_space_projeto . "/"
            . "Bundles" . "/"
            . $this->project->bundle;

        //dd($this->pathBundleName);

        //Seto a base de dados
        Tables::setDatabase($this->project->nome_db_projeto);

        //Seto o caminho do projeto
        Tables::setDirProject($this->project->path_projeto_projeto);

        //Retorna todas as tabelas
        if(! $tables = Tables::getTables())
        {
            $this->info("Não há tabelas para ser processado");
            exit();
        }

        //Varre todas as tabelas do banco de dados
        foreach ($tables as  $value)
            //dd($tables);
            if ($this->confirm("Voce gostaria de criar o CRUD  $value ? [y|N]")) {{
                    //O Nome da entidade será o mesmo nome da tabela, se singular ou  plural
                 //dd( $this->pathBundleName   . "/" . "Entity" . "/" . ucfirst( $value->table_name) . ".php" );
                //$this->files->exists(Tables::getDirProject() . "");

                //Verifica se a entidade foi criada
                $this->isExistEntity($value);

                $this->info("----- 1 - Criando no direório DAO o arquivo Interface" . ucfirst($value) . "DAO.php" . " da entitade  $value -----");
                $this->createInterfaceEntityDAO($value);

                $this->info("----- 2 - Criando no diretório DAO o arquivo " . ucfirst($value) . "DAO.php" . " da entitade  $value -----");
                $this->createEntityDAO($value);

                $this->info("----- 3 - Criando no diretório RN o arquivo " . ucfirst($value) . "RN.php" . " da entitade  $value -----");
                $this->createEntityRN($value);


                $this->info("----- 4 - Criando no diretório FORM o arquivo " . ucfirst($value) . "TYPE.php" . " da entitade  $value  -----");
                $this->createEntityType($value);

                $this->info("----- 5 - Criando no diretório Controller o arquivo " . ucfirst($value) . "Controller.php" . " da entitade  $value -----");
                $this->createEntityController($value);
            }
        }

        $this->info("----- Fim do Processo -----");
    }

    //Se não existir a entidade para o processo
    public function  isExistEntity($table_name)
    {

        if(!$this->files->exists($this->pathBundleName   . "/" . "Entity" . "/" . ucfirst( $table_name) . ".php"))
        {
            $this->info("Não existe a entidade " . $table_name );
            exit();
        }
    }

    //Gera a interface
    public function createInterfaceEntityDAO($table_name)
    {
        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->pathFileInterfaceEntityDAO);

        Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
        Generic::setReplacements(['CLASS_NAME' =>  ucfirst( $table_name)]);
        Generic::setReplacements(['BUNDLE_NAME' =>  $this->project->bundle]);
        //dd(Generic::getReplacements());
        //dd(Generic::getContents(Generic::getReplacements()));
        //dd($this->pathBundleName . "/" . "DAO" . "/" . "Interface" . ucfirst( $table_name) . "DAO" . ".php");

        $pathFileInterfaceEntityDAO = $this->pathBundleName . "/" . "DAO" . "/" . "Interface" . ucfirst( $table_name) . "DAO" . ".php";
        //$pathFileInterfaceEntityDAO = $this->pathBundleName . "/" . "DAO" . "/" . "Interface" . "Teste" . "DAO" . ".php";


        $this->writeClass($pathFileInterfaceEntityDAO , Generic::getContents(Generic::getReplacements()));
    }

    public function createEntityDAO($table_name)
    {
        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->pathFileEntityDAO);

        Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
        Generic::setReplacements(['CLASS_NAME' =>  ucfirst( $table_name)]);
        Generic::setReplacements(['BUNDLE_NAME' =>  $this->project->bundle]);
        $pathFileInterfaceEntityDAO = $this->pathBundleName . "/" . "DAO" . "/" . ucfirst( $table_name) . "DAO" . ".php";

        $this->writeClass($pathFileInterfaceEntityDAO , Generic::getContents(Generic::getReplacements()));

    }

    public function createEntityRN($table_name)
    {
        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->pathFileEntityRN);

        Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
        Generic::setReplacements(['CLASS_NAME' =>  ucfirst( $table_name)]);
        Generic::setReplacements(['BUNDLE_NAME' =>  $this->project->bundle]);
        $pathFileInterfaceEntityDAO = $this->pathBundleName . "/" . "RN" . "/" . ucfirst( $table_name) . "RN" . ".php";

        $this->writeClass($pathFileInterfaceEntityDAO , Generic::getContents(Generic::getReplacements()));

    }

    public function createEntityType($table_name)
    {
        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->pathFileEntityType);

        Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
        Generic::setReplacements(['CLASS_NAME' =>  ucfirst( $table_name)]);
        Generic::setReplacements(['BUNDLE_NAME' =>  $this->project->bundle]);
        $pathFileInterfaceEntityDAO = $this->pathBundleName . "/" . "Form" . "/" . ucfirst( $table_name) . "Type" . ".php";

        $this->writeClass($pathFileInterfaceEntityDAO , Generic::getContents(Generic::getReplacements()));

    }

    #Cria a entidadeType.php
    public function createEntityController($table_name)
    {
        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->pathFileEntityController);

        Generic::setReplacements(['NAMESPACE' => $this->project->name_space_projeto]);
        Generic::setReplacements(['CLASS_NAME' =>  ucfirst( $table_name)]);
        Generic::setReplacements(['CLASS_NAME1' =>  $table_name]);
        Generic::setReplacements(['BUNDLE_NAME' =>  $this->project->bundle]);
        $pathFileInterfaceEntityDAO = $this->pathBundleName . "/" . "Controller" . "/" . ucfirst( $table_name) . "Controller" . ".php";

        $this->writeClass($pathFileInterfaceEntityDAO , Generic::getContents(Generic::getReplacements()));

    }

    public function writeClass($path , $schema)
    {
        Generic::saveTo($path, $schema);
        //Lipo todas as variaveis
        Generic::clearReplacements();
    }
}
