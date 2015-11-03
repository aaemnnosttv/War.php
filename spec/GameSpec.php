<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use War\CardsCollection;
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

    function it_is_initializable()
    {
        $this->shouldHaveType('War\Game');
    }

    function it_plays_until_one_player_has_no_more_cards()
    {
        $this->play();

        $this->loser()->hasCards()->shouldReturn(false);
        $this->winner()->hasCards()->shouldReturn(true);
    }

}
