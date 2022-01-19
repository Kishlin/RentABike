<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\RentABike\Bikes\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Kishlin\Backend\RentABike\Bikes\Domain\BikeId;
use Kishlin\Backend\RentABike\Bikes\Infrastructure\Persistence\Doctrine\BikeIdType;
use PHPUnit\Framework\TestCase;
use ReflectionException;

final class BikeIdTypeTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testTypeName(): void
    {
        $this->assertEquals('bike_id', (new BikeIdType())->getName());
    }
    
    /**
     * @throws ConversionException
     */
    public function testConversionToDatabaseValue(): void
    {
        $type = new BikeIdType();

        $uuid = '51cefa3e-c223-469e-a23c-61a32e4bf048';

        $converted = $type->convertToDatabaseValue(new BikeId($uuid), $this->platform());

        $this->assertIsString($converted);
        $this->assertEquals($uuid, $converted);
    }

    /**
     * @throws ConversionException
     */
    public function testConversionToPHPValue(): void
    {
        $type = new BikeIdType();

        $uuid = '51cefa3e-c223-469e-a23c-61a32e4bf048';

        $converted = $type->convertToPHPValue($uuid, $this->platform());

        $this->assertInstanceOf(BikeId::class, $converted);
        $this->assertEquals($uuid, $converted->value());
    }

    /**
     * @return AbstractPlatform
     */
    private function platform(): object
    {
        return $this->getMockForAbstractClass(AbstractPlatform::class);
    }
}
