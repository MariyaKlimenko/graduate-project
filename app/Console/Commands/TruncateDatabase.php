<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean database.';

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
        $tables = DB::select('SHOW TABLES');
        $databaseName = config('database.connections.mysql.database');
        $tableName = 'Tables_in_' . $databaseName;

        $this->info(count($tables) . ' found');
        $this->info('Starting database cleanup...');

        DB::statement('SET foreign_key_checks = 0');

        foreach ($tables as $table) {
            Schema::drop($table->{$tableName});
            $this->info('Table ' . $table->{$tableName} . ' dropped');
        }

        $this->info('Database ' . $databaseName . ' successfully truncated!');

        DB::statement("SET foreign_key_checks = 1");
    }
}
