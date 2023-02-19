<?php

namespace App\Coupon\Command;

require_once('./App/Command/CommandInterface.php');


use App\Command\CommandInterface;

class CreateCouponCommand implements CommandInterface
{
    public $discount,  $discount_type, $unique_code;

    public function __construct(int $discount, int $discount_type, string $unique_code)
    {
        $this->discount = $discount;
        $this->discount_type = $discount_type;
        $this->unique_code = $unique_code;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getDiscountType()
    {
        return $this->discount_type;
    }

    public function getUniqueCode()
    {
        return $this->unique_code;
    }
}
