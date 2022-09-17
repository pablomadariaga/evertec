<?php

namespace App\Models;

use App\Enums\OrderStateEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['customer', 'orderDetails'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_state_id' => OrderStateEnum::class,
    ];

    /********************* Database relations *********************/

    /**
     * Get all of the orderDetails for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get the orderState associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderState(): BelongsTo
    {
        return $this->belongsTo(OrderState::class);
    }

    /**
     * Get the customer associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /********************* Query scopes *********************/

    /**
     * Scope a query to only include orders by orderState.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $orderStateId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetAllByOrderState($query,int $orderStateId)
    {
        return $query->where('order_state_id', $orderStateId);
    }

    /********************* Accessors & Mutators *********************/

    /**
     * Get the product's total.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => formatAmount($value),
        );
    }

    /**
     * Get the product's reference.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function reference(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str($value)->upper(),
        );
    }

    /**
     * Get the product's create date.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => dateToHuman($value,true),
        );
    }




}
