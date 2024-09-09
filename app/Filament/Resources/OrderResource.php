<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\FilesRelationManager;
use App\Models\Order;
use App\Models\OrderFile;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

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
                                $orderFile = new OrderFile([
                                    'order_id' => $record->id,
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
                TextColumn::make('file')
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
