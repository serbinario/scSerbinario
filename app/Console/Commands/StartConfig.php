<?php

namespace SCSerbinario\Console\Commands;

use Hamcrest\Util;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class StartConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sc_config:create {projectName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera a configuração inicial.';

    /*
     * Nome do projeto
     */
    private $projectName;

    /*
     * Nome de todas as namespace
     */
    private $serbinario;

    private $schedule;

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct(Schedule $schedule)
    {
        parent::__construct();
        $this->schedule = $schedule;
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
        if (File::directories('../' . $projectName)) {

            $this->info("----- Instalando o DebugBar -----");
            //shell_exec('cd ../' . $projectName . '/ && composer require barryvdh/laravel-debugbar');
            //echo shell_exec(' ls ../projeto1' );
            //$output = shell_exec('php composer.phar require barryvdh/laravel-debugbar');

            $this->info("----- Instalando o illuminate/html -----");
           // shell_exec('cd ../' . $projectName . '/ && composer require illuminate/html');

            $this->info("----- Instalando o datatables-oracle -----");
            //shell_exec('cd ../' . $projectName . '/ && composer require yajra/laravel-datatables-oracle');

            $this->info("----- Instalando o prettus/l5-repository -----");
            //shell_exec('cd ../' . $projectName . '/ && composer require prettus/l5-repository');

            $this->info("----- Instalando o Vendor prettus/l5-repository -----");
            //shell_exec('cd ../' . $projectName . '/ && php artisan vendor:publish');

            /*
             * Copio o arquivo app.php já com os prividers e
             */

            //$this->copyFile('app.php', $projectName,  'path');

            /*
             * Aplico uma namespace
             */
            $this->info("----- Aplicando NamesPace Serbinario -----");
            shell_exec('cd ../' . $projectName . '/ && php artisan app:name  Serbinario');


        }
    }

    /**
     * @param $file
     * @param $projectName
     * @param $path
     */
    public function copyFile($file, $projectName, $path)
    {
        $path = app_path();
        $base = base_path();
        echo $path . '/Util/' . $file . " - " . public_path();

        File::copy($path . '/Util/app.php' , '/home/paulo/Projetos/TesteSC/config/app.php');
    }
}
