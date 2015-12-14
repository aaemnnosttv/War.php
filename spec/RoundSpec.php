<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Card;
use War\Player;

class RoundSpec extends ObjectBehavior
{
    function it_accepts_two_players_and_determines_the_victor()
    {
        $winner = new Player('Player 1', [new Card('A', 'spades')]);

        $this->beConstructedWith(
            $winner,
            new Player('Player 2', [new Card('2', 'spades')])
        );

        $this->play()->victor()->shouldReturn($winner);
    }
}
