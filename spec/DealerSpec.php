<?php

namespace spec\War;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use War\Card;
use War\CardsCollection;
use War\Deck;
use War\Player;

class DealerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Deck(new CardsCollection()));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('War\Dealer');
    }

    function it_deals_the_cards_evenly_between_players($player1, $player2)
    {
        $player1->beADoubleOf(Player::class);
        $player2->beADoubleOf(Player::class);

        $card1 = new Card('A', 'spades');
        $card2 = new Card('J', 'hearts');

        $this->beConstructedWith(new Deck(CardsCollection::from($card1, $card2)));

        $player1->acceptCard($card1)->shouldBeCalledTimes(1);
        $player2->acceptCard($card2)->shouldBeCalledTimes(1);

        $this->deal($player1, $player2);
    }
}
