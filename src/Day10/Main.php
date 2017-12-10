<?php

namespace Liquorvicar\AdventOfCode\Day10;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain {
    private $list;

    public function __construct($length = 256)
    {
        $this->list = range(0, $length - 1);
    }

    public function runPartOne(array $input)
    {
        $lengths =  explode(',', $input[0]);
        $string = new StringCircle($this->list, 0, 0);
        foreach ($lengths as $length) {
            $string = $string->tieKnot((int)$length);
        }
        return $string->checksum();
    }

    public function runPartTwo(array $input)
    {
        $bytes = trim($input[0]);
        if ($bytes !== '') {
            $chars = str_split($bytes);
        } else {
            $chars = [];
        }
        $lengths = array_map(function ($element) {
            return ord($element);
        }, $chars);
        $lengths = array_merge($lengths, [17, 31, 73, 47, 23]);
        $string = new StringCircle($this->list, 0, 0);
        for ($i = 1; $i <= 64; $i++) {
            foreach ($lengths as $length) {
                $string = $string->tieKnot((int)$length);
            }
        }
        return $string->denseHash();
    }

}