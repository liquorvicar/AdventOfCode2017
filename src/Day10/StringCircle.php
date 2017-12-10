<?php

namespace Liquorvicar\AdventOfCode\Day10;

class StringCircle
{
    /** @var int[] */
    private $list;
    /** @var int */
    private $position;
    /** @var int */
    private $skip;

    /**
     * @param int[] $list
     * @param int $position
     * @param int $skip
     */
    public function __construct(array $list, int $position, int $skip)
    {
        $this->list = $list;
        $this->position = $position;
        $this->skip = $skip;
    }

    /**
     * @param int $length
     * @return StringCircle
     */
    public function tieKnot($length)
    {
        $newList = array_merge(
            array_slice($this->list, $this->position),
            array_slice($this->list, 0, $this->position)
        );
        $reversedPortion = array_reverse(array_slice($newList, 0, $length));
        array_splice($newList, 0, $length, $reversedPortion);
        $newList = array_merge(
            array_slice($newList, count($newList) - $this->position),
            array_slice($newList, 0, count($newList) - $this->position)
        );
        $newPosition = $this->position + $length + $this->skip;
        while ($newPosition >= count($newList)) {
            $newPosition -= count($newList);
        }
        return new StringCircle(array_values($newList), $newPosition, ($this->skip + 1));
    }

    public function checksum()
    {
        return $this->list[0] * $this->list[1];
    }

    public function denseHash()
    {
        $hashParts = [];
        for ($i = 0; $i <= 15; $i++) {
            $section = array_slice($this->list, ($i * 16), 16);
            $hashParts[] = $this->denseElement($section);
        }
        return $this->calcHash($hashParts);
    }

    public function denseElement($section) {
        return array_reduce($section, function ($dense, $element) {
            if (is_null($dense)) {
                return $element;
            }
            return $dense ^ $element;
        }, null);
    }

    public function calcHash($hashParts)
    {
        return array_reduce($hashParts, function ($hex, $element) {
            return $hex . str_pad(dechex($element), 2, '0', STR_PAD_LEFT);
        }, '');
    }
}