<?php
namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Exception\DinosaursAreRunningRampantException;
use AppBundle\Exception\NotBufferException;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function testItHasNoDinosaursByDefault()
    {
        $enclosure = new Enclosure();
        $this->assertEmpty($enclosure->getDinosaurs());

    }

    public function testItAddsDinosaurs()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur());
        $enclosure->addDinosaur(new Dinosaur());
        $this->assertCount(2, $enclosure->getDinosaurs());
    }

    public function testItDoesNotAllowCarnivorousDinosaursWithHerbivores()
{
    $enclosure = new Enclosure(true);
    $enclosure->addDinosaur(new Dinosaur());
    $this->expectException(NotBufferException::class);
    $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
}

    /**
     * @expectedException \AppBundle\Exception\NotBufferException
     */
    public function testItDoesNotAllowToAddNonCarnivorousDinosaursToCarnivorousEnclosure()
{
    $enclosure = new Enclosure(true);
    $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    $enclosure->addDinosaur(new Dinosaur());

}

    public function  testItDoesNotAllowToAddDinosaursToUnsecureEnclosures(){
        $enclosure = new Enclosure();
        $this->expectException(DinosaursAreRunningRampantException::class);
        $this->expectExceptionMessage('Are you crazy???');
        $enclosure->addDinosaur(new Dinosaur());
}
}