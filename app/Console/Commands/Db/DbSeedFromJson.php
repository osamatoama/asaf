<?php

namespace App\Console\Commands\Db;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class DbSeedFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed-from-json {--db=} {--base-url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with JSON dumped data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = $this->option('base-url') ?? null;
        $dbName = $this->option('db') ?? env('DB_DATABASE');
        $excludedTables = [
            'audit_logs',
        ];

        if (empty($baseUrl)) {
            $this->error('Base URL is required');
            return;
        }

        $tables =array_diff(getDbTables($dbName), $excludedTables);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            $this->info("Seeding $table table");

            for ($i = 1; true; $i++) {
                try {
                    $response = Http::get($baseUrl . "$table/$i.json");

                    if ($response->status() == 404) {
                        break;
                    }

                    $rows = $response->json();
                    DB::table($table)->insert($rows);
                    $this->line("chunk $i");
                } catch (\Throwable $th) {
                    $this->error("Chunk $i error");
                }
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
