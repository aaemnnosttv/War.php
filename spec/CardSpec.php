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
}
