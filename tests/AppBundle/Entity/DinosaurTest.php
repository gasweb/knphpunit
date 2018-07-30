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
        $this->assertGreaterThan(15, $dinosaur->getLength(), 'Did you put it in washing machine');
    }

    public function testReturnsFullSpecificationOfDinosaur(){
        $dinosaur = new Dinosaur();

        $this->assertSame('The Unknown non-carnivorous dinosaur is 0 meters long',
            $dinosaur->getSpecification());
    }
}