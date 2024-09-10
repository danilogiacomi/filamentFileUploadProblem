<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PollingOrderResource\Pages;
use App\Filament\Resources\PollingOrderResource\RelationManagers\FilesRelationManager;
use App\Models\PollingOrder;
use App\Models\PollingOrderFile;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PollingOrderResource extends Resource
{
    protected static ?string $model = PollingOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
               
                Actions::make([
                    Action::make('mass-upload-images')
                        ->stickyModalHeader()
                        ->stickyModalFooter()
                        ->icon('heroicon-m-document-arrow-up')
                        ->form([
                            FileUpload::make('files')
                                ->multiple()
                                ->directory(function ($record) {
                                    return '2dModel/' . $record->id . '/' . Carbon::now()->format('Y.m.d_h.i.s');
                                })
                                ->moveFiles()
                                ->image()
                                ->preserveFilenames()
                        ])
                        ->action(function (array $data, $record) {
                            Notification::make()
                                ->title(__('The files are being transformed, soon you will be able to see them'))
                                ->info()
                                ->send();
                            foreach ($data['files'] as $fileName){
                                $orderFile = new PollingOrderFile([
                                    'polling_order_id' => $record->id,
                                    'file' => $fileName
                                ]);
                                $orderFile->save();
                            }
                        })
                        ->hidden(function (string $operation) {
                            return $operation == 'create';
                        })
                        ,
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            FilesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPollingOrders::route('/'),
            'create' => Pages\CreatePollingOrder::route('/create'),
            'edit' => Pages\EditPollingOrder::route('/{record}/edit'),
        ];
    }
}
