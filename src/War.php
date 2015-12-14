<?php

namespace War;

class War extends Battle
{
    public function fight()
    {
        // these are the "face down" cards
        $this->takePair();

        return parent::fight();
    }
}
