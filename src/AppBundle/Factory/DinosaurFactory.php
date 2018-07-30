<?php
namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptors(int $length): Dinosaur
    {
        return $this->createDinosaur('Velociraptor', true, $length);

    }

    public function createDinosaur(string $genus, bool $isCarnivorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);

        $dinosaur->setLength($length);

        return $dinosaur;
    }

    public function growFromSpecification(string $specification): Dinosaur
    {

    }
}