<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Card;
use War\Player;

class BattleSpec extends ObjectBehavior
{
    function let()
    {
        $player1 = new Player('One', [new Card('A', 'spades')]);
        $player2 = new Player('Two', [new Card('2', 'hearts')]);

        $this->beConstructedWith($player1, $player2);
    }

    function it_accepts_two_players_and_evaluates_the_victor()
    {
        $player1 = new Player('One', [new Card('A', 'spades')]);
        $player2 = new Player('Two', [new Card('2', 'hearts')]);

        $this->beConstructedWith($player1, $player2);

        $this->fight();
        $this->victor()->shouldReturn($player1);
    }
}
