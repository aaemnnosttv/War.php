<?php

namespace War;

use War\Exceptions\NoCardsToPlayException;

class Player
{
    /* @string */
    public $name;

    /* @var CardsCollection */
    private $cards;

    /* @var CardsCollection */
    private $captured;

    /**
     * Player constructor.
     *
     * @param       $name
     * @param array $cards
     */
    public function __construct( $name, array $cards = [] )
    {
        $this->name = $name;
        $this->cards = CardsCollection::make($cards);
        $this->captured = new CardsCollection();
    }

    public function acceptCard(Card $card)
    {
        $this->cards->push($card);
    }

    public function cardsCount()
    {
        return $this->cards->count();
    }

    public function playCard()
    {
        if ( ! $this->hasCards()) {
            throw new NoCardsToPlayException();
        }

        if ( $this->cards->isEmpty() ) {
            $this->reloadFromCaptured();
        }

        return $this->cards->shift();
    }

    public function won(Battle $battle)
    {
        foreach($battle->collect() as $card) {
            $this->captured->push($card);
        }
    }

    public function capturedCount()
    {
        return $this->captured->count();
    }

    public function hasCards()
    {
        return (bool) ($this->cardsCount() + $this->capturedCount());
    }

    protected function reloadFromCaptured()
    {
        $this->cards = $this->cards->make($this->captured->shuffle()->all());
        $this->captured->toZero();
    }
}
