<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('A', 'spades');
        $this->shouldHaveType('War\Card');
    }

    function it_has_a_method_for_getting_the_suit()
    {
        $this->beConstructedWith('A', 'spades');
        $this->suit()->shouldReturn('spades');
    }

    function it_has_a_method_for_getting_the_value()
    {
        $this->beConstructedWith('J', 'spades');
        $this->value()->shouldReturn(11);
    }
}
