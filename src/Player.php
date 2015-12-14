<?php

namespace War;

use Illuminate\Support\Collection;
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
    public function __construct($name, array $cards = [])
    {
        $this->name     = $name;
        $this->cards    = CardsCollection::make($cards);
        $this->captured = new CardsCollection();
    }

    /**
     * Add a card to the player's main collection of cards
     *
     * @param Card $card
     */
    public function acceptCard(Card $card)
    {
        $this->cards->push($card);
    }

    /**
     * Get the number of cards in the main collection
     * @return int
     */
    public function cardsCount()
    {
        return $this->cards->count();
    }

    /**
     * Play the next card
     * @return mixed
     * @throws NoCardsToPlayException
     */
    public function playCard()
    {
        if ( ! $this->hasCards()) {
            throw new NoCardsToPlayException();
        }

        if ($this->cards->isEmpty()) {
            $this->reloadFromCaptured();
        }

        return $this->cards->shift();
    }

    /**
     * Capture a collection of cards
     *
     * @param Collection $victory
     */
    public function capture(Collection $victory)
    {
        $this->captured->assimilate($victory);
    }

    public function capturedCount()
    {
        return $this->captured->count();
    }

    public function hasCards()
    {
        return (bool)($this->cardsCount() + $this->capturedCount());
    }

    protected function reloadFromCaptured()
    {
        $this->cards = $this->cards->make($this->captured->shuffle()->all());
        $this->captured->toZero();
    }
}
