<?php

namespace App\Console\Commands\Db;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DbDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump database table to a file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('database dump in progress');

        $dbName = $this->option('db') ?? env('DB_DATABASE') ?? 'defaultdb';
        $excludedTables = [];

        $tables =array_diff(getDbTables($dbName), $excludedTables);

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            if (! is_dir(public_path("dump"))) {
                mkdir(public_path("dump"));
            }

            if (! is_dir(public_path("dump/$table"))) {
                mkdir(public_path("dump/$table"));
            } else {
                array_map( 'unlink', array_filter((array) glob(public_path("dump/$table") . '/*') ) );
            }

            $orderCol = Schema::hasColumn($table, 'id') ? 'id' : Schema::getColumnListing($table)[0];

            DB::table($table)->orderBy($orderCol)->chunk(500, function($chunk) use ($table) {
                static $i = 1;
                file_put_contents(public_path("dump/$table/$i.json"), json_encode($chunk->toArray(), JSON_UNESCAPED_UNICODE));
                $i++;
            });

            $this->info("Table $table dumped");
        }
    }
}
