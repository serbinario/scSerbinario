<?php

namespace SCSerbinario\Console\Commands;


use SCSerbinario\Util\SqlMigrations;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ConvertMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * dirPorject = Diretorio do projeto
     * databae = nome do banco
     * --ignore = quais sao as tabelas que tem que ser ignoradas --ignore="table1, table2 ...."
     */
    protected $signature = 'convert:migrations { dirProject } { database } {--ignore=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ignoreInput = str_replace(' ', '', $this->option('ignore'));
        $ignoreInput = explode(',', $ignoreInput);
        $migrate = new SqlMigrations();
        $migrate->ignore($ignoreInput);

        if (File::directories('../' . $this->argument('dirProject'))) {
            $migrate->dirProject($this->argument('dirProject'));
            $migrate->convert($this->argument('database'));
            $migrate->write();
            $this->info('Migration Created Successfully');

        }
    }
}
