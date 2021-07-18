<?php

namespace War;

use War\Exceptions\NoCardsToPlayException;

class Game
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
    private $winner;
    /**
     * @var Player
     */
    private $loser;
    /**
     * @var Dealer
     */
    private $dealer;
    /**
     * @var Collection
     */
    private $rounds;

    /**
     * Game constructor.
     *
     * @param Player $player1
     * @param Player $player2
     * @param Dealer $dealer
     */
    public function __construct(Player $player1, Player $player2, Dealer $dealer)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->dealer  = $dealer;
        $this->rounds  = new Collection;
    }

    public function play()
    {
        $this->dealer->deal($this->player1, $this->player2);

        while ($this->playersHaveCards()) {
            $this->playRound();
        }

        $this->endGame();
    }

    public function winner()
    {
        return $this->winner;
    }

    public function loser()
    {
        return $this->loser;
    }

    public function rounds()
    {
        return $this->rounds;
    }

    protected function endGame()
    {
        $this->loser = ! $this->player1->hasCards()
            ? $this->player1
            : $this->player2;

        $this->winner = $this->player1 == $this->loser
            ? $this->player2
            : $this->player1;
    }

    /**
     * @return bool
     */
    protected function playersHaveCards()
    {
        return $this->player1->hasCards() && $this->player2->hasCards();
    }

    protected function playRound()
    {
        $round = new Round($this->player1, $this->player2);

        try {
            $round->play();
            $round->victor()->capture($round->cardsPlayed());
            $this->rounds->push($round);
        } catch (NoCardsToPlayException $e) {
            $this->endGame();
        }
    }

}
