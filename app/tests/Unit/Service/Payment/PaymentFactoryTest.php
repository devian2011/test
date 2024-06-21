<?php

namespace Unit\Service\Payment;

use App\Service\Payment\PaymentException;
use App\Service\Payment\PaymentFactory;
use App\Service\Payment\PaymentProcessorInterface;
use App\Service\Payment\UnknownPaymentProcessorException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PaymentFactoryTest extends KernelTestCase
{
    public function testFactoryInitFailWrongInterface()
    {

        $processors = [
            new class {}
        ];
        $this->expectException(PaymentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Wrong payment processor. Expected: %s - Class: %s',
                PaymentProcessorInterface::class,
                get_class($processors[0])
            )
        );
        new PaymentFactory($processors);
    }

    public function testFactoryInitFailSameCodeExists()
    {
        $processors = [
            new class implements PaymentProcessorInterface {
                public function getCode(): string
                {
                    return 'get';
                }

                public function pay(float $price): bool
                {
                    return true;
                }
            },
            new class implements PaymentProcessorInterface {
                public function getCode(): string
                {
                    return 'get';
                }

                public function pay(float $price): bool
                {
                    return true;
                }
            }
        ];
        $this->expectException(PaymentException::class);
        $this->expectExceptionMessage(
            sprintf(
                "Processor with code: 'get' already existed. Exists: %s Put: %s",
                get_class($processors[0]),
                get_class($processors[1])
            )
        );
        new PaymentFactory($processors);
    }

    public function testGetProcessor()
    {
        $processors = [
            new class implements PaymentProcessorInterface {
                public function getCode(): string
                {
                    return 'get';
                }

                public function pay(float $price): bool
                {
                    return true;
                }
            }
        ];
        $factory = new PaymentFactory($processors);
        $processor = $factory->getProcessor('get');
        $this->assertInstanceOf(PaymentProcessorInterface::class, $processor);
        $this->assertTrue($processor->pay(100));
        $this->assertEquals('get', $processor->getCode());
    }

    public function testGetProcessorFail()
    {
        $this->expectException(UnknownPaymentProcessorException::class);
        $factory = new PaymentFactory();
        $factory->getProcessor('test');
    }
}
