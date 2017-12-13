<?php

namespace Liquorvicar\AdventOfCode\Day13;

class Firewall
{
    private $ranges;
    private $layers;
    private $directions;

    public function __construct($config)
    {
        $this->ranges = $config;
        $this->layers = [];
        $this->directions = [];
        foreach (array_keys($config) as $layer) {
            $this->layers[$layer] = 0;
            $this->directions[$layer] = 1;
        }
    }

    public function scan($picoSeconds) {
        $endPositions = $this->layers;
        for ($i = 1; $i <= $picoSeconds; $i++) {
            $endPositions = $this->moveScanners($endPositions);
        }
        return $endPositions;
    }

    private function moveScanners($startPositions)
    {
        $endPositions = $startPositions;
        foreach ($this->directions as $layer => $direction) {
            $endPositions[$layer] += $direction;
            if ($endPositions[$layer] === ($this->ranges[$layer] - 1) || $endPositions[$layer] === 0) {
                $this->directions[$layer] = $direction * -1;
            }
        }
        return $endPositions;
    }

    public function isCaught($picoSeconds)
    {
        $endPositions = $this->layers;
        for ($i = 1; $i <= $picoSeconds; $i++) {
            $endPositions = $this->moveScanners($endPositions);
        }
        return $this->caughtAtPosition($picoSeconds, $endPositions);
    }

    public function severity()
    {
        $severity = 0;
        $max = array_reduce(array_keys($this->ranges), function ($max, $element) {
            return $max > $element ? $max : $element;
        }, 0);
        $endPositions = $this->layers;
        for ($i = 1; $i <= $max; $i++) {
            $endPositions = $this->moveScanners($endPositions);
            if ($this->caughtAtPosition($i, $endPositions)) {
                $severity += ($i * $this->ranges[$i]);
            }
        }
        return $severity;
    }

    /**
     * @param $picoSeconds
     * @param $endPositions
     * @return bool
     */
    private function caughtAtPosition($picoSeconds, $endPositions): bool
    {
        if (!isset($endPositions[$picoSeconds])) {
            return false;
        }
        return $endPositions[$picoSeconds] === 0;
    }
}

