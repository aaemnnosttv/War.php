<?php

namespace War;

class Dealer
{
    /**
     * @var Deck
     */
    private $deck;

    /**
     * Dealer constructor.
     *
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Deals the cards evenly between the two players
     *
     * @param Player $player1
     * @param Player $player2
     */
    public function deal(Player $player1, Player $player2)
    {
        $players = [$player1, $player2];

        while ($this->deck->hasCards()) {
            list($dealTo, $next) = $players;
            $dealTo->acceptCard($this->deck->shift());
            $players = [$next, $dealTo];
        }
    }

    /**
     * Shuffle the deck of cards
     *
     * @return $this
     */
    public function shuffle()
    {
        $this->deck->shuffle();

        return $this;
    }
}
