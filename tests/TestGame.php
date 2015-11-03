<?php

class TestGame extends PHPUnit_Framework_TestCase
{
    /* @test */
    public function it_requires_two_players_to_play()
    {
        $this->setExpectedException('War\\Exception\\InsufficientPlayerCountException');

        new War\Game;

    }
}