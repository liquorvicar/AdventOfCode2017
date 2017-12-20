<?php

namespace Liquorvicar\AdventOfCode\Day20;

class Particle
{
    /** @var Vector */
    private $position;
    /** @var Vector */
    private $velocity;
    /** @var Vector */
    private $acceleration;

    /**
     * @param Vector $position
     * @param Vector $velocity
     * @param Vector $acceleration
     */
    public function __construct(Vector $position, Vector $velocity, Vector $acceleration)
    {
        $this->position = $position;
        $this->velocity = $velocity;
        $this->acceleration = $acceleration;
    }

    public function update(): Particle
    {
        $velocity = $this->velocity->add($this->acceleration);
        $position = $this->position->add($velocity);
        return new Particle($position, $velocity, $this->acceleration);
    }

    public function isEscaping()
    {
        return $this->velocity->direction() === $this->acceleration->direction() && $this->acceleration->direction() === $this->position->direction();
    }

    public function netAcceleration()
    {
        return $this->acceleration->net();
    }

    public function collidesWith(Particle $particle) {
        return $this->position->equals($particle->position);
    }
}

