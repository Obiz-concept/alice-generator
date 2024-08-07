<?php

namespace Trappar\AliceGenerator\Tests\Fixtures;

use Doctrine\ORM\Mapping as ORM;
use Trappar\AliceGenerator\Attribute as Fixture;

/**
 * @ORM\Entity()
 */
class DoctrinePersisterTesterGeneratorNone
{
    /**
     * @ORM\Column()
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    public $id;

}

