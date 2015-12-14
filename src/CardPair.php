<?php

namespace War;

use Illuminate\Contracts\Support\Arrayable;

class CardPair implements Arrayable
{
    /**
     * @var Card
     */
    public $player1;
    /**
     * @var Card
     */
    public $player2;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1->playCard();
        $this->player2 = $player2->playCard();
    }

    /**
     * Get the higher card of the pair, or false if equivalent
     * @return bool|mixed|Card
     */
    public function highCard()
    {
        if ($this->player1->value() > $this->player2->value()) {
            return $this->player1;
        }
        if ($this->player1->value() < $this->player2->value()) {
            return $this->player2;
        }

        return false;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            $this->player1,
            $this->player2
        ];
    }
}
