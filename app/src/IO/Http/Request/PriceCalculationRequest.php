<?php

namespace IO\Http\Request;

use App\UseCase\Good\PriceCalculationDataInterface;
use App\Extension\Validator\Coupon;
use App\Extension\Validator\Good;
use App\Extension\Validator\Tax;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints\NotBlank;

class PriceCalculationRequest implements PriceCalculationDataInterface
{


    public function __construct(
        #[NotBlank]
        #[Good]
        #[SerializedName("product_id")]
        private int     $productId,
        #[NotBlank]
        #[Tax]
        #[SerializedName("tax_number")]
        private string  $taxNumber,
        #[Coupon]
        #[SerializedName("coupon")]
        private ?string $couponCode = null
    )
    {

    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }
}
