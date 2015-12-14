<?php

namespace War;

class Deck extends CardsCollection
{
    protected static $suits = [
        'clubs',
        'diamonds',
        'hearts',
        'spades'
    ];

    protected static $faces = [
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        'J',
        'Q',
        'K',
        'A'
    ];

    /**
     * @return bool
     */
    public function hasCards()
    {
        return ! $this->isEmpty();
    }

    /**
     * Named constructor
     */
    public static function withAllCards()
    {
        $deck = new static();

        foreach (static::$suits as $suit) {
            foreach (static::$faces as $face) {
                $deck->push(new Card($face, $suit));
            }
        }

        return $deck;
    }
}
