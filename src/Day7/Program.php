<?php

namespace Liquorvicar\AdventOfCode\Day7;

class Program
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $weight;
    /**
     * @var array
     */
    private $balancedParts;

    /**
     * @param string $name
     * @param string $weight
     * @param array $balancedParts
     */
    public function __construct($name, $weight, $balancedParts)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->balancedParts = $balancedParts;
    }

    public function isBalancing()
    {
        return $this->balancedParts;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param Program[] $programs
     * @return int
     */
    public function weight(array $programs)
    {
        $balancedWeight = array_reduce($this->balancedParts, function ($weight, $name) use ($programs) {
            return $weight + $programs[$name]->weight($programs);
        }, 0);
        return (int)$this->weight + $balancedWeight;
    }

    /**
     * @return int
     */
    public function ownWeight() {
        return (int)$this->weight;
    }
}