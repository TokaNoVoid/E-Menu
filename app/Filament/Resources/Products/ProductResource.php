<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\ViewProduct;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Schemas\ProductInfolist;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use App\Models\Subscription;
use Auth;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ProductResource extends Resource
{
    
    protected static ?string $model = Product::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;
    protected static ?string $recordTitleAttribute = 'Produk';

    protected static string | UnitEnum | null $navigationGroup = 'Management';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationTitle = 'Produk';

    protected static ?string $pluralLabel = 'Produk';
    protected static ?string $singularLabel = 'Produk';

    public static function canCreate(): bool{
        if(Auth::user()->role === 'admin'){
            return true;
        }

        $subscription = Subscription::where('user_id', Auth::user()->id)
            ->where('end_date', '>', now())
            ->where('is_active', true)
            ->latest()
            ->first();

            $countProduct = Product::where('user_id', Auth::user()->id)->count();

            return !($countProduct >= 2 && !$subscription);
    }
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();


        return parent::getEloquentQuery()
            ->when($user->role !== 'admin', fn($query) => $query->where('user_id', $user->id));
    }

    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();

        $query = static::getModel()::query()
            ->when($user->role !== 'admin', fn($q) => $q->where('user_id', $user->id));

        return (string) $query->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}