<?php

namespace Liquorvicar\AdventOfCode\Day19;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    public function runPartOne(array $grid)
    {
        $position = $this->findStartingPoint($grid);
        while (!$position->hasReachedEnd()) {
            $position = $this->move($grid, $position);
        }
        return $position->path();
    }

    public function runPartTwo(array $grid)
    {
        $steps = 0;
        $position = $this->findStartingPoint($grid);
        while (!$position->hasReachedEnd()) {
            $steps++;
            $position = $this->move($grid, $position);
        }
        return $steps;
    }

    public function findStartingPoint($grid)
    {
        $firstLine = $grid[0];
        $x = strpos($firstLine, '|');
        return new Position($x, 0, 'D', '');
    }

    public function move($grid, Position $currentPosition)
    {
        $newX = $currentPosition->x();
        $newY = $currentPosition->y();
        switch ($currentPosition->direction()) {
            case 'D':
                $newY += 1;
                break;
            case 'R':
                $newX += 1;
                break;
            case 'U':
                $newY -= 1;
                break;
            case 'L':
                $newX -= 1;
                break;
        }
        $path = $currentPosition->path();
        $newLocation = substr($grid[$newY], $newX, 1);
        $direction = $currentPosition->direction();
        if ($newLocation === ' ') {
            return new Position($currentPosition->x(), $currentPosition->y(), $currentPosition->direction(), $currentPosition->path(), true);
        }
        if (!in_array($newLocation, ['|', '-', '+'])) {
            $path .= $newLocation;
        }
        if ($newLocation === '+') {
            if ($this->checkNewDirection($newX - 1, $newY, $currentPosition, $grid)) {
                $direction = 'L';
            } elseif ($this->checkNewDirection($newX + 1, $newY, $currentPosition, $grid)) {
                $direction = 'R';
            } elseif ($this->checkNewDirection($newX, $newY - 1, $currentPosition, $grid)) {
                $direction = 'U';
            } elseif ($this->checkNewDirection($newX, $newY + 1, $currentPosition, $grid)) {
                $direction = 'D';
            }
        }
        return new Position($newX, $newY, $direction, $path);
    }

    private function checkNewDirection($x, $y, Position $currentPosition, $grid)
    {
        if ($x === $currentPosition->x() && $y === $currentPosition->y()) {
            return false;
        }
        if (!isset($grid[$y])) {
            return false;
        }
        if (strlen($grid[$y]) < $x) {
            return false;
        }
        $nextSquare = substr($grid[$y], $x, 1);
        return $nextSquare && strlen(trim($nextSquare)) > 0;
    }
}

