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

    public function deal(Player $player1, Player $player2)
    {
        $dealTo = $player1;

        while($this->deck->hasCards())
        {
            $card = $this->deck->shift();
            $dealTo->acceptCard($card);
            $dealTo = $dealTo === $player1 ? $player2 : $player1;
        }
    }

    public function shuffle()
    {
        $this->deck = $this->deck->shuffle();

        return $this;
    }
}
