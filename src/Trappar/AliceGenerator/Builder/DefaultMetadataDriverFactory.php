<?php

namespace Trappar\AliceGenerator\Builder;

use Doctrine\ORM\Mapping\Driver\AttributeReader;
use Metadata\Driver\DriverChain;
use Metadata\Driver\FileLocator;
use Trappar\AliceGenerator\Metadata\Driver\YamlDriver;

class DefaultMetadataDriverFactory implements MetadataDriverFactoryInterface
{
    public function createDriver(array $metadataDirs, AttributeReader $attributeReader)
    {
        $attributeReader = new AttributeReader($attributeReader);

        if (!empty($metadataDirs)) {
            $fileLocator = new FileLocator($metadataDirs);

            return new DriverChain([
                new YamlDriver($fileLocator),
                $attributeReader
            ]);
        } else {
            return $attributeReader;
        }
    }
}