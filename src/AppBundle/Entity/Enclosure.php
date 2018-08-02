<?php
namespace AppBundle\Entity;

use AppBundle\Exception\NotBufferException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="enclosure")
 */
class Enclosure
{
    /**
     * @var Collection
     * @ORM\Column(targetEntity="AppBundle\Entity\Dinosaur", mappedBy="enclosure", cascade={"persist"})
     * @ORM\Column(type="string")
     */
    private $dinosaurs;

    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getDinosaurs(): Collection
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur): void
    {
        if (!$this->canAddDinosaur($dinosaur))
        {
            throw new NotBufferException();
        }
        $this->dinosaurs[] = $dinosaur;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) === 0 || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
    }




}