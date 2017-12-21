<?php

namespace Liquorvicar\AdventOfCode\Day21;

class Rule
{
    private $rows;
    private $replacement;
    private $size;
    private $numOnPixels;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $ruleParts = explode('=>', $string);
        $this->rows = explode('/', trim($ruleParts[0]));
        $this->replacement = explode('/', trim($ruleParts[1]));
    }

    public function matches(Grid $grid)
    {
        return $grid->matches($this->rows);
    }

    public function replacement()
    {
        return $this->replacement;
    }
}