<?php

namespace App\IO\Http\Request;

use App\Extension\Validator\Coupon;
use App\Extension\Validator\Good;
use App\Extension\Validator\PaymentProvider;
use App\Extension\Validator\Tax;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\UseCase\Purchase\PurchaseInterface;

class PurchaseRequest implements PurchaseInterface
{
    public function __construct(
        #[Good]
        #[NotBlank]
        #[SerializedName("product_id")]
        private readonly int     $productId,
        #[Tax]
        #[NotBlank]
        #[SerializedName("tax_number")]
        private readonly string  $taxNumber,
        #[PaymentProvider]
        #[NotBlank]
        #[SerializedName("payment_processor")]
        private readonly string $paymentProcessor,
        #[Coupon]
        #[SerializedName("coupon")]
        private readonly ?string $couponCode = null
    )
    {

    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getPaymentProvider(): string
    {
        return $this->paymentProcessor;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }
}