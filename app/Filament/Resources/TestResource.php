<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Models\Test;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('color_id')
                    ->label(__('Colors'))
                    ->default('blue')
                    ->native(false)
                    ->selectablePlaceholder(false)
                    ->createOptionForm([
                        Repeater::make('colors')
                            ->simple(
                                ColorPicker::make('color_name')
                                    ->required(),
                            ),
                    ])
                    ->createOptionUsing(function (array $data): string {
                        return 'Test';
                    })
                    ->options([
                        'blue' => __('Blue'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                Filter::make('create_colors')
                    ->form([
                        Select::make('color_id')
                            ->label(__('Colors'))
                            ->default('blue')
                            ->native(false)
                            ->selectablePlaceholder(false)
                            ->createOptionForm([
                                Repeater::make('colors')
                                    ->simple(
                                        ColorPicker::make('color_name')
                                            ->required(),
                                    ),
                            ])
                            ->createOptionUsing(function (array $data): string {
                                return 'Test';
                            })
                            ->options([
                                'blue' => __('Blue'),
                            ]),
                    ]),
            ], layout: FiltersLayout::AboveContent)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
