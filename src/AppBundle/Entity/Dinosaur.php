<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{
    /**
     * @ORM\Column(type="integer")
     */
    private $length = 0;

    /**
     * @ORM\Column(type="string")
     */
    private $genus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCarnivorous;


    public function __construct(string $genus='Unknown', bool $isCarnivorous = false)
    {
        $this->isCarnivorous = $isCarnivorous;
        $this->genus = $genus;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getSpecification(): string
    {
        return sprintf('The %s %scarnivorous dinosaur is %d meters long',
        $this->genus,
            $this->isCarnivorous ? '' : 'non-',
        $this->getLength()
        );
    }

    public function getGenus()
    {
        return $this->genus;
    }
}
