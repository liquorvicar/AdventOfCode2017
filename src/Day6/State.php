<?php

namespace Liquorvicar\AdventOfCode\Day6;

class State
{
    private $banks;

    /**
     * @param $banks
     */
    public function __construct($banks)
    {
        $this->banks = $banks;
    }

    public function reallocate() {
        $banks = $this->banks;
        asort($banks);
        $keys = array_keys($banks);
        $largestBank = array_pop($keys);
        $toReallocate = $banks[$largestBank];
        $largest = array_filter($banks, function ($value) use ($toReallocate) {
            return $value === $toReallocate;
        });
        ksort($largest);
        reset($largest);
        $largestBank = key($largest);
        $banks[$largestBank] = 0;
        ksort($banks);
        $nextIndex = $largestBank;
        while ($toReallocate > 0) {
            $nextIndex = $nextIndex + 1;
            if ($nextIndex >= count($banks)) {
                $nextIndex = 0;
            }
            $banks[$nextIndex] += 1;
            $toReallocate -= 1;
        }
        return new State($banks);
    }

    public function __toString()
    {
        return implode('+', $this->banks);
    }
}