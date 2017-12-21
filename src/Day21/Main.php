<?php

namespace Liquorvicar\AdventOfCode\Day21;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $program = [[new Grid(['.#.', '..#', '###'])]];
        $rules = [];
        foreach ($input as $rule) {
            $rules[] = new Rule($rule);
        }
        return $this->countPixels($rules, $program, 5);
    }

    public function runPartTwo(array $input)
    {
        $program = [[new Grid(['.#.', '..#', '###'])]];
        $rules = [];
        foreach ($input as $rule) {
            $rules[] = new Rule($rule);
        }
        return $this->countPixels($rules, $program, 18);
    }

    /**
     * @param array $program
     * @param Rule[] $rules
     * @return array
     */
    public function process($program, $rules)
    {
        $newProgram = [];
        $rows = 0;
        foreach ($program as $y => $row) {
            foreach ($row as $x => $grid) {
                foreach ($rules as $rule) {
                    if ($rule->matches($grid)) {
                        $replacement = $rule->replacement();
                        foreach ($replacement as $rowId => $value) {
                            if (!isset($newProgram[$rows + $rowId])) {
                                $newProgram[$rows + $rowId] = '';
                            }
                            $newProgram[$rows + $rowId] .= $value;
                        }
                        break;
                    }
                }
            }
            $rows = count($newProgram);
        }
        return $newProgram;
    }

    /**
     * @param array $processedGrid
     * @return Grid[]
     */
    public function regrid($processedGrid)
    {
        $newGrid = [];
        if (strlen($processedGrid[0]) % 2 === 0) {
            $gridSize = 2;
        } else {
            $gridSize = 3;
        }
        $y = 0;
        while ($y < count($processedGrid)) {
            $newRow = [];
            for ($i = 0; $i < (strlen($processedGrid[0]) / $gridSize); $i++) {
                $actualGrid = [];
                for ($j = 0; $j < $gridSize; $j++) {
                    $actualGrid[] = substr($processedGrid[$y + $j], ($i * $gridSize), $gridSize);
                }
                $newRow[] = new Grid($actualGrid);
            }
            $newGrid[$y/$gridSize] = $newRow;
            $y += $gridSize;
        }
        return $newGrid;
    }

    /**
     * @param Rule[] $rules
     * @param array $program
     * @param $iterations
     * @return int
     */
    public function countPixels($rules, $program, $iterations)
    {
        for ($i = 1; $i <= $iterations; $i++) {
            $processedGrid = $this->process($program, $rules);
            $program = $this->regrid($processedGrid);
            echo $i . PHP_EOL;
        }
        $pixels = 0;
        foreach ($program as $row) {
            $pixels += array_reduce($row, function ($sum, Grid $grid) {
                return $sum + $grid->pixels();
            }, 0);
        }
        return $pixels;
    }
}