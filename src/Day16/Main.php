<?php

namespace Liquorvicar\AdventOfCode\Day16;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    private $dancers;

    public function __construct($size = 16)
    {
        $this->dancers = range(0, $size - 1);
        $this->dancers = array_map(function ($element) {
            return chr(ord('a') + $element);
        }, $this->dancers);
    }

    public function runPartOne(array $input)
    {
        $dancers = $this->dancers;
        $danceMoves = explode(',', $input[0]);
        $dancers = $this->doMoves($danceMoves, $dancers);
        return implode($dancers);
    }

    public function runPartTwo(array $input)
    {
        $dancers = $this->dancers;
        $danceMoves = explode(',', $input[0]);
        $seenMoves = [implode($dancers)];
        $remain = 0;
        for ($i = 1; $i <= 1000000000; $i++) {
            $dancers = $this->doMoves($danceMoves, $dancers);
            $danceOrder = implode($dancers);
            echo $danceOrder . PHP_EOL;
            if (in_array($danceOrder, $seenMoves)) {
                echo $i;
                $remain = 1000000000 % $i;
                break;
            }
            $seenMoves[] = $danceOrder;
        }
        for ($i = 1; $i <= $remain; $i++) {
            $dancers = $this->doMoves($danceMoves, $dancers);
        }
        return implode($dancers);
    }

    /**
     * @param $dancers
     * @param $first
     * @param $second
     * @return mixed
     */
    protected function swop($dancers, $first, $second)
    {
        $dancer = $dancers[$first];
        $dancers[$first] = $dancers[$second];
        $dancers[$second] = $dancer;
        return $dancers;
    }

    /**
     * @param $danceMoves
     * @param $dancers
     * @return array|mixed
     */
    protected function doMoves($danceMoves, $dancers)
    {
        foreach ($danceMoves as $danceMove) {
            $command = substr($danceMove, 0, 1);
            $size = substr($danceMove, 1);
            switch ($command) {
                case 's':
                    $dancers = array_merge(
                        array_slice($dancers, count($dancers) - $size),
                        array_slice($dancers, 0, count($dancers) - $size)
                    );
                    break;
                case 'x':
                    $positions = explode('/', $size);
                    $dancers = $this->swop($dancers, $positions[0], $positions[1]);
                    break;
                case 'p':
                    $positions = explode('/', $size);
                    $first = array_keys($dancers, $positions[0])[0];
                    $second = array_keys($dancers, $positions[1])[0];
                    $dancers = $this->swop($dancers, $first, $second);
                    break;
            }
        }
        return $dancers;
    }
}