<?php

namespace Trappar\AliceGenerator\Metadata\Driver;

use Doctrine\ORM\Mapping\Driver\AttributeReader;
use Metadata\Driver\DriverInterface;
use Metadata\MergeableClassMetadata;
use Trappar\AliceGenerator\Attribute as Fixture;
use Trappar\AliceGenerator\Metadata\PropertyMetadata;
use Metadata\ClassMetadata;

class AttributeDriver implements DriverInterface
{
    /**
     * @var AttributeReader
     */
    private $reader;

    public function __construct(AttributeReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param \ReflectionClass $class
     *
     * @return \Metadata\ClassMetadata
     */
    public function loadMetadataForClass(\ReflectionClass $class): ?ClassMetadata
    {
        $classMetadata                  = new MergeableClassMetadata($name = $class->name);
        $classMetadata->fileResources[] = $class->getFileName();

        foreach ($class->getProperties() as $property) {
            $propertyMetadata = new PropertyMetadata($name, $property->getName());
            $propertyAttributes = $this->reader->getPropertyAttributes($property);

            foreach ($propertyAttributes as $attribute) {
                if ($attribute instanceof Fixture\Data) {
                    $propertyMetadata->staticData = $attribute->value;
                } elseif ($attribute instanceof Fixture\Faker) {
                    $propertyMetadata->fakerName = $attribute->name;
                    $propertyMetadata->fakerResolverType = $attribute->type;
                    $propertyMetadata->fakerResolverArgs = $attribute->arguments;
                } elseif ($attribute instanceof Fixture\Ignore) {
                    $propertyMetadata->ignore = true;
                }
            }

            $classMetadata->addPropertyMetadata($propertyMetadata);
        }

        return $classMetadata;
    }
}
