<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /********************* Database relations *********************/

    /**
     * Get all of the orderDetails for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }


    /********************* Accessors & Mutators *********************/

    /**
     * Get the product's price.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => formatAmount($value),
        );
    }
}
