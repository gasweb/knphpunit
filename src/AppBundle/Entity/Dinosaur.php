<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{
    const LARGE = 10;

    const HUGE = 30;

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

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Enclosure", inversedBy="dinosaurs")
     */
    private $enclosure;


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

    public function isCarnivorous(): bool
    {
        return $this->isCarnivorous;
    }
}
