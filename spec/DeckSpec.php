<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\CardsCollection;

class DeckSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('War\Deck');
    }

    function it_has_52_cards()
    {
        $fullDeck = $this::withAllCards();
        $fullDeck->count()->shouldBe(52);
    }
}
