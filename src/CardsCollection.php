<?php

namespace War;

use Illuminate\Support\Collection;

class CardsCollection extends Collection
{
    public function toZero()
    {
        $this->items = [];
    }

    public function assimilate(Collection $collection)
    {
        $this->items = $this->merge($collection)->all();
    }

    public static function from(... $cards)
    {
        return new static($cards);
    }
}
