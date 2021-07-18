<?php

namespace War;

class CardsCollection extends Collection
{
    public function toZero()
    {
        $this->items = [];
    }

    public static function from(... $cards)
    {
        return new static($cards);
    }
}
