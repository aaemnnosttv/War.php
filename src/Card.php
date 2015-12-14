<?php

namespace War;

class Card
{
    private $face;

    private $suit;

    private $faceLookup = [
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'A' => 14
    ];

    /**
     * Card constructor.
     *
     * @param $face
     * @param $suit
     */
    public function __construct($face, $suit)
    {
        $this->face = $face;
        $this->suit = $suit;
    }

    public function suit()
    {
        return $this->suit;
    }

    public function value()
    {
        return is_numeric($this->face)
            ? (int)$this->face
            : array_get($this->faceLookup, $this->face);
    }
}
