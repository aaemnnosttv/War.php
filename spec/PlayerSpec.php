<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Battle;
use War\Card;
use War\CardsCollection;
use War\Exceptions\NoCardsToPlayException;
use War\Player;
use War\Round;

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

    function it_captures_a_collection_of_cards_from_a_victorious_round()
    {
        $this->beConstructedWith(['Winner', [new Card('A', 'spades')]]);

        $this->capture($this->getVictoriousRound()->cardsPlayed());

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

        $cards = CardsCollection::make([
            new Card('A', 'spades'),
            new Card('2', 'spades'),
        ]);

        $this->capturedCount()->shouldBe(0);
        $this->capture($cards);
        $this->capturedCount()->shouldBe(2);

        $this->playCard(); // reloads from captured and plays
        $this->cardsCount()->shouldBe(1);
    }

    /**
     * @return Round
     */
    protected function getVictoriousRound()
    {
        $winner = new Player('Player 1', [new Card('A', 'spades')]);

        $round = new Round(
            $winner,
            new Player('Loser', [new Card('2', 'clubs')])
        );
        $round->play();

        return $round;
    }
}
