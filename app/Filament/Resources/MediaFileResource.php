<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\MediaFile;
use Filament\Tables\Table;
use App\Models\MediaFolder;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MediaFileResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\MediaFileResource\RelationManagers;

class MediaFileResource extends Resource
{
    protected static ?string $model = MediaFile::class;

    protected static ?string $slug = 'files';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'الملفات';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'ملف';

    protected static ?string $pluralModelLabel = 'الملفات';

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
                            ->rules(['string', 'max:255']),

                        Select::make('folder_id')
                            ->label('المجلد')
                            ->options(MediaFolder::all()->pluck('name', 'id'))
                            ->required()
                            ->rules(['exists:media_folders,id'])
                            ->searchable(),

                        SpatieMediaLibraryFileUpload::make('file')
                            ->label('الملف')
                            ->disk('media')
                            ->collection('default'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم'),

                TextColumn::make('folder.name')
                    ->label('المجلد'),

                TextColumn::make('attachment.file_name')
                    ->label('اسم الملف')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    }),

                TextColumn::make('attachment.mime_type')
                    ->label('نوع الملف'),

                TextColumn::make('attachment.size')
                    ->label('مساحة التخزين')
                    ->numeric()
                    ->formatStateUsing(fn (string $state): string => round($state / (1024 ** 2), 2) . ' MB'),
            ])
            ->filters([
                SelectFilter::make('folder')
                    ->relationship('folder', 'name')
                    ->label('المجلد'),
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
            'index' => Pages\ListMediaFiles::route('/'),
            'create' => Pages\CreateMediaFile::route('/create'),
            // 'edit' => Pages\EditMediaFile::route('/{record}/edit'),
        ];
    }
}
