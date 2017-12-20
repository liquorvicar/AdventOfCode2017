<?php

namespace Liquorvicar\AdventOfCode\tests\Day20;

use Liquorvicar\AdventOfCode\Day20\Particle;
use Liquorvicar\AdventOfCode\Day20\Vector;
use Liquorvicar\AdventOfCode\Day20\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    public function testUpdateValues() {
        $currentParticle = new Particle(new Vector(3, 0, 0), new Vector(2, 0, 0), new Vector(-1, 0, 0));
        $updatedParticle = new Particle(new Vector(4, 0, 0), new Vector(1, 0, 0), new Vector(-1, 0, 0));
        $this->assertEquals($updatedParticle, $currentParticle->update());
    }

    /**
     * @param Particle $particle
     * @param $isEscaping
     * @dataProvider dataForEscapeVelocity
     */
    public function testIsEscaping(Particle $particle, $isEscaping) {
        $this->assertEquals($isEscaping, $particle->isEscaping());
    }

    public function dataForEscapeVelocity() {
        return [
            [new Particle(new Vector(3, 0, 0), new Vector(2, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(4, 0, 0), new Vector(1, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(4, 0, 0), new Vector(0, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(3, 0, 0), new Vector(-1, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(2, 0, 0), new Vector(-1, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(1, 0, 0), new Vector(-1, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(0, 0, 0), new Vector(-1, 0, 0), new Vector(-1, 0, 0)), false],
            [new Particle(new Vector(-1, 0, 0), new Vector(-2, 0, 0), new Vector(-1, 0, 0)), true],
            [new Particle(new Vector(4, 0, 0), new Vector(0, 0, 0), new Vector(-2, 0, 0)), false],
            [new Particle(new Vector(2, 0, 0), new Vector(-2, 0, 0), new Vector(-2, 0, 0)), false],
            [new Particle(new Vector(-2, 0, 0), new Vector(-4, 0, 0), new Vector(-2, 0, 0)), true],
        ];
    }

    /**
     * @param $rawInput
     * @param $expectedParticle
     * @dataProvider dataForParseInput
     */
    public function testParseInput($rawInput, $expectedParticle) {
        $main = new Main();
        $this->assertEquals($expectedParticle, $main->parse($rawInput));
    }

    public function dataForParseInput() {
        return [
            [
                'p=<-926,2122,1918>, v=<-132,303,276>, a=<9,-23,-19>',
                new Particle(
                    new Vector(-926,2122,1918),
                    new Vector(-132,303,276),
                    new Vector(9,-23,-19)
                )
            ],
        ];
    }

    public function testNetAcceleration() {
        $particle =
            new Particle(
                new Vector(-926,2122,1918),
                new Vector(-132,303,276),
                new Vector(9,-23,-19)
            );
        $this->assertEquals(51, $particle->netAcceleration());
    }

}
