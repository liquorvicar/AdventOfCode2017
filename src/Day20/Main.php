<?php

namespace Liquorvicar\AdventOfCode\Day20;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    public function runPartOne(array $input)
    {
        $particles = array_map(function ($input) {
            return $this->parse($input);
        }, $input);
        $netAccel = array_map(function (Particle $particle) {
            return $particle->netAcceleration();
        }, $particles);
        asort($netAccel);
        return key($netAccel);
    }

    public function runPartTwo(array $input)
    {
        $particles = array_map(function ($input) {
            return $this->parse($input);
        }, $input);
        $max = count($particles);
        $iterations = 1;
        while (true) {
            $collisions = [];
            foreach ($particles as $key => $particle) {
                for ($i = ($key + 1); $i < $max; $i++) {
                    if (!isset($particles[$i])) {
                        continue;
                    }
                    /** @var $particle Particle */
                    if ($particle->collidesWith($particles[$i])) {
                        $collisions[] = $key;
                        $collisions[] = $i;
                    }
                }
            }
            foreach ($collisions as $collided) {
                unset($particles[$collided]);
            }
            if (count($collisions) > 0) {
                echo $iterations . ':' . count($particles) . PHP_EOL;
            }
            $particles = array_map(function (Particle $particle) {
                return $particle->update();
            }, $particles);
            $iterations++;
        }
    }

    public function parse($rawInput): Particle
    {
        $rawInput = str_replace('p=<', '', $rawInput);
        $rawInput = str_replace('v=<', '', $rawInput);
        $rawInput = str_replace('a=<', '', $rawInput);
        $rawInput = str_replace('>', '', $rawInput);
        $inputParts = explode(',', $rawInput);
        $inputParts = array_map(function ($element) {
            return (int)trim($element);
        }, $inputParts);
        return new Particle(
            new Vector($inputParts[0], $inputParts[1], $inputParts[2]),
            new Vector($inputParts[3], $inputParts[4], $inputParts[5]),
            new Vector($inputParts[6], $inputParts[7], $inputParts[8])
        );
    }
}