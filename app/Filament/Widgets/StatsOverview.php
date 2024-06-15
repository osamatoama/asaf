<?php

namespace App\Filament\Widgets;

use App\Models\MediaFile;
use App\Models\MediaFolder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('المجلدات', MediaFolder::count()),
            Stat::make('الملفات', MediaFile::count()),
        ];
    }
}
