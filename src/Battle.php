<?php

namespace War;

class Battle
{
    /**
     * @var Player
     */
    private $player1;
    /**
     * @var Player
     */
    private $player2;
    /**
     * @var Player
     */
    private $victor;

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
        $this->cards = new CardsCollection();
    }

    public function fight()
    {
        if ($this->victor instanceof Player) {
            return $this;
        }

        $p1Card = $this->player1->playCard();
        $p2Card = $this->player2->playCard();

        $this->take($p1Card, $p2Card);

        if ($p1Card->value() > $p2Card->value()) {
            $this->victor = $this->player1;
            return $this;
        }
        if ($p1Card->value() < $p2Card->value()) {
            $this->victor = $this->player2;
            return $this;
        }

//        $this->victor = false;
        // WAR!
        // One card "down" for each player, then we fight again
        $this->take($this->player1->playCard(), $this->player2->playCard());
        $this->fight();
    }

    protected function take(Card $card1, Card $card2)
    {
        $this->cards->push($card1);
        $this->cards->push($card2);
    }

    public function collect()
    {
        return $this->cards->all();
    }

    public function victor()
    {
        return $this->victor;
    }

}
