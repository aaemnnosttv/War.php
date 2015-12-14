<?php

namespace War;

class Battle
{
    /**
     * @var Player
     */
    protected $player1;
    /**
     * @var Player
     */
    protected $player2;
    /**
     * @var Player
     */
    protected $victor;
    /**
     * @var CardsCollection
     */
    protected $pairs;

    /**
     * Battle constructor.
     *
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->pairs   = new CardsCollection();
    }

    /**
     * Takes a card from each player and compares them to
     * determine the victor
     *
     * @return $this
     */
    public function fight()
    {
        $pair = $this->takePair();

        if ($pair->player1 === $pair->highCard()) {
            $this->victor = $this->player1;
        }
        if ($pair->player2 === $pair->highCard()) {
            $this->victor = $this->player2;
        }

        return $this;
    }

    /**
     * Takes one card from each player and creates a new Card pair
     *
     * @return CardPair
     */
    protected function takePair()
    {
        $pair = new CardPair($this->player1, $this->player2);
        $this->pairs->push($pair);

        return $pair;
    }

    /**
     * Transform the CardPairs into a flat collection
     *
     * @return CardsCollection
     */
    public function collect()
    {
        return $this->pairs
            ->map(function ($pair) {
                return $pair->toArray();
            })
            ->flatten()
            ;
    }

    /**
     * Get the victor of the battle
     *
     * @return Player
     */
    public function victor()
    {
        return $this->victor;
    }

}
