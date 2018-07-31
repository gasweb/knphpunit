<?php
namespace Tests\AppBundle\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;

class DinosaurFactoryTest extends TestCase
{
    /**
     * @var DinosaurFactory
     */
    private $factory;

    public function setUp(): void
    {
        $this->factory = new DinosaurFactory();
    }

    public function testItGrowsAVelociraptor()
    {
        $dinosaur = $this->factory->growVelociraptors(5);

        $this->assertInstanceOf(Dinosaur::class, $dinosaur);
        $this->assertInternalType('string', $dinosaur->getGenus());
        $this->assertEquals('Velociraptor', $dinosaur->getGenus());
        $this->assertSame(5, $dinosaur->getLength());
    }

    public function testItGrowsATriceraptors()
    {
        $this->markTestIncomplete('Waiting for confirmation from GenLab');
    }

    public function testItGrowsABabyVelociraptor()
    {
        if (!class_exists('Nanny')){
            $this->markTestSkipped('There is nobody to watch the baby');
        }

        $dinosaur = $this->factory->growVelociraptors(1);
    }

    /**
     * @dataProvider growSpecificationTests
     */
    public function testItGrowsADinosaurFromASpecification(string $spec, bool $expectedIsLarge, bool $expectedIsCarnivorous)
    {

        $dinosaur = $this->factory->growFromSpecification($spec);

        if($expectedIsLarge){
            $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dinosaur->getLength());

        } else{
            $this->assertLessThan(Dinosaur::LARGE, $dinosaur->getLength());
        }

        $this->assertSame($expectedIsCarnivorous, $dinosaur->isCarnivorous(), 'Diets do not match');
    }

    public function growSpecificationTests(): array
    {
        return [
            //Specification, is large, is carnivorous
            ['large carnivorous dinosaur', true, true],
            'default response' => ['give me a cookies', false, false],
            ['large herbivore', true, false]
        ];
    }

    /**
     * @dataProvider getHugeDinosaurSpecificationTests
     */
    public function testItGrowsAHugeDinosaur(string $specification){
        $dinosaur = $this->factory->growFromSpecification($specification);
        $this->assertGreaterThanOrEqual(Dinosaur::HUGE, $dinosaur->getLength());
    }

    public function getHugeDinosaurSpecificationTests(){
        return [
            ['huge dinosaur'],
            ['huge dino'],
            ['huge'],
            ['OMG'],
            ['😱'],
        ];
    }
}