<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaFolder;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaFolderResource\Pages;
use App\Filament\Resources\MediaFolderResource\RelationManagers;

class MediaFolderResource extends Resource
{
    protected static ?string $model = MediaFolder::class;

    protected static ?string $slug = 'folders';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'المجلدات';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'مجلد';

    protected static ?string $pluralModelLabel = 'المجلدات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                        'sm' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->rules(['string', 'max:255']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('الاسم'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaFolders::route('/'),
            'create' => Pages\CreateMediaFolder::route('/create'),
            // 'edit' => Pages\EditMediaFolder::route('/{record}/edit'),
        ];
    }
}
