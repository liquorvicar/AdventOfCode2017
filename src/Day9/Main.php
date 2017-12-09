<?php

namespace Liquorvicar\AdventOfCode\Day9;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $input = $input[0];
        $groups = $this->parseGroups($input);
        return array_sum($groups);
    }

    public function runPartTwo(array $input)
    {
        $input = $input[0];
        return strlen($this->removeGarbage($input)['garbage']);
    }

    public function removeGarbage($input)
    {
        $output = '';
        $chars = str_split($input);
        $isGarbage = false;
        $ignored = false;
        $garbage = '';
        foreach ($chars as $char) {
            if ($ignored) {
                $ignored = false;
                continue;
            }
            if ($char == '!') {
                $ignored = true;
                continue;
            }
            if ($char == '<' && !$isGarbage) {
                $isGarbage = true;
                continue;
            }
            if ($char == '>') {
                $isGarbage = false;
                continue;
            }
            if (!$isGarbage) {
                $output.= $char;
            } else {
                $garbage.= $char;
            }
        }
        return ['clean' => $output, 'garbage' => $garbage];
    }

    public function parseGroups($input)
    {
        $groups = [];
        $chars = str_split($this->removeGarbage($input)['clean']);
        $depth = 0;
        foreach ($chars as $char) {
            if ($char === '{') {
                $depth++;
            }
            if ($char === '}') {
                $groups[] = $depth;
                $depth--;
            }
        }
        return $groups;
    }
}