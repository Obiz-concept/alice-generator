<?php

namespace Trappar\AliceGenerator\Attribute;

final class Faker implements FixtureAttributeInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $arguments;
}