<?php
namespace AppBundle\Entity;

use AppBundle\Exception\DinosaursAreRunningRampantException;
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

    /**
     * @var Collection|Security[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Security, mappedBy="enclosure", cascade={"persist"})
     */
    private $securities;

    public function __construct(bool $withBasicSecurity = false)
    {
        $this->dinosaurs = new ArrayCollection();
        $this->securities = new ArrayCollection();

        if ($withBasicSecurity){
            $this->addSecurity(new Security('Fence', true, $this));
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getDinosaurs(): Collection
    {
        return $this->dinosaurs;
    }

    /**
     * @param Dinosaur $dinosaur
     * @throws DinosaursAreRunningRampantException
     * @throws NotBufferException
     */
    public function addDinosaur(Dinosaur $dinosaur): void
    {
        if (!$this->canAddDinosaur($dinosaur))
        {
            throw new NotBufferException();
        }

        if (!$this->isSecurityActive())
        {
            throw new DinosaursAreRunningRampantException('Are you crazy???');
        }
        $this->dinosaurs[] = $dinosaur;
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }

    public function isSecurityActive(): bool
    {
        foreach ($this->securities as $security) {
            if ($security->getIsActive()) {
                return true;
            }
        }

        return false;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) === 0 || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
    }




}