<?php

namespace Database\Seeders;

use App\Models\MediaFolder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MediaFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folders = [
            '3saf',
            'laverne',
        ];

        foreach ($folders as $folder) {
            MediaFolder::firstOrCreate(['name' => $folder], [
                'parent_id' => null,
            ]);
        }
    }
}
