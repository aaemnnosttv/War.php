<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Battle;
use War\Card;
use War\Exceptions\NoCardsToPlayException;
use War\Player;

class PlayerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('John');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('War\Player');
    }

    function it_accepts_new_cards()
    {
        $this->cardsCount()->shouldBe(0);

        $this->acceptCard(new Card('2', 'clubs'));

        $this->cardsCount()->shouldBe(1);
    }

    function its_cards_decrease_by_1_when_a_card_is_played()
    {
        $this->acceptCard(new Card('2', 'clubs'));

        $this->cardsCount()->shouldBe(1);

        $this->playCard();

        $this->cardsCount()->shouldBe(0);
    }

    function it_accepts_all_cards_from_a_won_battle()
    {
        $this->beConstructedWith(['Winner', [new Card('A', 'spades')]]);

        $this->won($this->getVictoriousBattle());

        $this->capturedCount()->shouldBe(2);
    }

    function it_throws_an_exception_if_it_tries_to_play_with_no_cards()
    {
        $this->beConstructedWith('I have no cards');
        $this->shouldThrow(NoCardsToPlayException::class)->during('playCard');
    }

    function it_tells_if_it_has_cards()
    {
        $this->hasCards()->shouldReturn(false);
        $this->acceptCard(new Card('2', 'clubs'));
        $this->hasCards()->shouldReturn(true);
    }

    function it_uses_captured_cards_after_it_runs_out($battle)
    {
        $this->cardsCount()->shouldBe(0);

        $battle->beADoubleOf(Battle::class);
        $battle->collect()->willReturn([
           new Card('A', 'spades'),
           new Card('2', 'spades'),
        ]);

        $this->capturedCount()->shouldBe(0);
        $this->won($battle);
        $this->capturedCount()->shouldBe(2);

        $this->playCard(); // reloads from captured and plays
        $this->cardsCount()->shouldBe(1);
    }

    /**
     * @return Battle
     */
    protected function getVictoriousBattle()
    {
        $winner = $this->getWrappedObject();
        $winner->acceptCard(new Card('A', 'spades'));

        $battle  = new Battle(
            $winner,
            new Player('Loser', [new Card('2', 'clubs')])
        );
        $battle->fight();

        return $battle;
    }
}
