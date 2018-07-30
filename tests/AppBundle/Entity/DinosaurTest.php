<?php
namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{
    public function testSettingLength(){
        $dinasaour = new Dinosaur();
        $this->assertSame(0, $dinasaour->getLength());

        $dinasaour->setLength(9);

        $this->assertSame(9, $dinasaour->getLength());
    }

    public function testDinosaurIsNotShrunk(){
        $dinosaur = new Dinosaur();
        $dinosaur->setLength(15);
        $this->assertGreaterThan(12, $dinosaur->getLength(), 'Did you put it in washing machine');
    }

    public function testReturnsFullSpecificationForTyrannosaurus()
    {
        $dinosaur = new Dinosaur('Tirannosaurus', true);
        $dinosaur->setLength(12);
        $this->assertSame('The Tirannosaurus carnivorous dinosaur is 12 meters long',
            $dinosaur->getSpecification());

    }

    public function testReturnsFullSpecificationOfDinosaur(){
        $dinosaur = new Dinosaur();

        $this->assertSame('The Unknown non-carnivorous dinosaur is 0 meters long',
            $dinosaur->getSpecification());
    }
}