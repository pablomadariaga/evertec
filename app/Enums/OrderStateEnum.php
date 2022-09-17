<?php

namespace App\Enums;

enum OrderStateEnum: int
{
    case Created = 1;
    case Approved = 2;
    case Rejected = 3;
    case Pending = 4;

    /**
     * Get order status enum
     *
     * @return string
     */
    public function label(): string {
        return static::getLabel($this);
    }

    /**
     * Get label of enum case
     *
     * @param self $value
     * @return string
     */
    public static function getLabel(self $value): string {
        return match ($value) {
            OrderStateEnum::Created => __('Created'),
            OrderStateEnum::Approved => __('Payed'),
            OrderStateEnum::Rejected => __('Rejected'),
            OrderStateEnum::Pending => __('Pending'),
        };
    }
}
