<?php

namespace Trappar\AliceGenerator\Builder;

use Doctrine\ORM\Mapping\Driver\AttributeReader;
use Metadata\Driver\DriverInterface;

interface MetadataDriverFactoryInterface
{
    /**
     * @param array $metadataDirs
     * @param AttributeReader $attributeReader
     *
     * @return DriverInterface
     */
    public function createDriver(array $metadataDirs, AttributeReader $attributeReader);
}