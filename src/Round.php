<?php

namespace War;

use Illuminate\Support\Collection;

class Round
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
     * @var Collection
     */
    private $battles;

    /**
     * Round constructor.
     *
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->battles = new Collection();
    }

    /**
     * Play the round
     *
     * @return $this
     */
    public function play()
    {
        $battle = new Battle($this->player1, $this->player2);

        if ($this->battle($battle)->victor()) {
            return $this;
        }

        // if the initial battle does not have a winner
        // any subsequent battles for this round can only be wars

        while ( ! $this->victor()) {
            $war = new War($this->player1, $this->player2);
            $this->battle($war);
        }

        return $this;
    }

    /**
     * @param $battle
     *
     * @return $this
     */
    protected function battle(Battle $battle)
    {
        $battle->fight();
        $this->battles->push($battle);

        return $this;
    }

    /**
     * Get the winner of the Round
     * @return bool|Player
     */
    public function victor()
    {
        if ($this->battles->isEmpty()) {
            return false;
        }

        return $this->battles->last()->victor();
    }

    /**
     * Get all cards played this round as a flat collection of cards
     * @return static
     */
    public function cardsPlayed()
    {
        return $this->battles->map(function ($battle) {
            return $battle->collect()->all();
        })->flatten()
            ;
    }

}
