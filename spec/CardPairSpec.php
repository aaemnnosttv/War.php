<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Card;
use War\Player;

class CardPairSpec extends ObjectBehavior
{
    function it_holds_one_card_for_each_player()
    {
        $p1Card  = new Card('A', 'spades');
        $player1 = new Player('One', [$p1Card]);

        $p2Card  = new Card('2', 'hearts');
        $player2 = new Player('Two', [$p2Card]);

        $this->beConstructedWith($player1, $player2);

        $this->player1->shouldBe($p1Card);
        $this->player2->shouldBe($p2Card);
    }

    function it_knows_how_to_determine_which_card_is_higher()
    {
        $p1Card  = new Card('A', 'spades');
        $player1 = new Player('One', [$p1Card]);

        $p2Card  = new Card('2', 'hearts');
        $player2 = new Player('Two', [$p2Card]);

        $this->beConstructedWith($player1, $player2);

        $this->highCard()->shouldReturn($p1Card);
    }
}
