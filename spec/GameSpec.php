<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use War\CardsCollection;
use War\Card;
use War\Deck;
use War\Player;
use War\Dealer;

class GameSpec extends ObjectBehavior
{
    /**
     *
     */
    function let()
    {
        $this->beConstructedWith(
            new Player('One'),
            new Player('Two'),
            new Dealer(Deck::withAllCards())
        );
    }

    function it_plays_until_one_player_has_no_more_cards()
    {
        $this->play();

        $this->loser()->hasCards()->shouldReturn(false);
        $this->winner()->hasCards()->shouldReturn(true);
    }

    function it_records_the_number_of_rounds()
    {
        $this->beConstructedWith(
            new Player('One', [
                new Card('A','spades'),
                new Card('A','clubs'),
                new Card('A','hearts'),
                new Card('A','diamonds')
            ]),
            new Player('Two', [
                new Card('2','spades'),
                new Card('2','clubs'),
                new Card('2','hearts'),
                new Card('2','diamonds')
            ]),
            new Dealer(new Deck)
        );

        $this->play();

        $this->rounds()->count()->shouldBe(4);
    }

}
