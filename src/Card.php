<?php

namespace War;

class Card
{
    public $face;

    public $suit;

    public $value;

    protected $faceLookup = [
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
        $this->face  = $face;
        $this->suit  = $suit;
        $this->value = array_get($this->faceLookup, $face, (int) $face);
    }
}
