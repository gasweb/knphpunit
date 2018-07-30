<?php
namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptors(int $length): Dinosaur
    {
        return $this->createDinosaur('Velociraptor', true, $length);

    }

    public function growFromSpecification(string $specification): Dinosaur
    {
        //Defaults
        $codeName = 'InG-'.random_int(1, 99999);
        $length = false;
        $isCarnivorous = false;

        if (stripos($specification, 'large') !== false){
            $length = random_int(1, Dinosaur::LARGE-1);
        } else{
            $length = random_int(Dinosaur::LARGE, Dinosaur::LARGE+10);
        }

        $dinosaur = $this->createDinosaur($codeName, $isCarnivorous, $length);
        return $dinosaur;
    }

    public function createDinosaur(string $genus, bool $isCarnivorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);

        $dinosaur->setLength($length);

        return $dinosaur;
    }
}