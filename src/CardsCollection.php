<?php

namespace War;

use Illuminate\Support\Collection;

class CardsCollection extends Collection
{
    public function toZero()
    {
        $this->items = [];
    }

    public static function from(Card ... $cards)
    {
        return new static($cards);
    }
}
