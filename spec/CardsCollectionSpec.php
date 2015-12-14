<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Card;

class CardsCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('War\CardsCollection');
    }

    function it_has_a_named_constructor_which_accepts_individual_cards_as_arguments()
    {
        $collection = $this::from(
            new Card('2', 'hearts'),
            new Card('3', 'clubs'),
            new Card('4', 'diamonds')
        );
        $collection->count()->shouldReturn(3);
    }
}
