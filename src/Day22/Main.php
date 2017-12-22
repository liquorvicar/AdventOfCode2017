<?php

namespace Liquorvicar\AdventOfCode\Day22;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    public function runPartOne(array $input)
    {
        $grid = array_map(function ($element) {
            return str_split(trim($element));
        }, $input);
        return $this->countInfectedNodes($grid, 10000);
    }

    public function runPartTwo(array $input)
    {
        // TODO: Implement runPartTwo() method.
    }

    public function countInfectedNodes($grid, $iterations)
    {
        $grid = new Grid($grid);
        $start = $grid->findCentre();
        $carrier = new Carrier($start['x'], $start['y'], Carrier::UP);
        for ($i = 1; $i <= $iterations; $i++) {
            $carrier = $carrier->burst($grid);
        }
        return $grid->countInfected();
    }

}