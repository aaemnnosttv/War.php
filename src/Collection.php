<?php

namespace War;

class Collection
{
    /**
     * @var array
     */
    protected $items;

    public static function make($items = [])
    {
        return new static($items);
    }

    public function __construct($items = [])
    {
        if ($items instanceof Collection) {
            $items = $items->all();
        }
        $this->items = $items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return $this->items === [];
    }

    public function shift()
    {
        return array_shift($this->items);
    }

    public function push($item)
    {
        array_push($this->items, $item);

        return $this;
    }

    public function last()
    {
        return $this->items[$this->count() - 1] ?? null;
    }

    /**
     * @return static
     */
    public function map(callable $function)
    {
        return static::make(
            array_map(
                $function,
                $this->items,
                array_keys($this->items)
            )
        );
    }

    public function flatten()
    {
        $flat = [];
        $func = function ($arr) use (&$flat, &$func) {
            if (! is_array($arr)) {
                $flat[] = $arr;
                return;
            }
            foreach ($arr as $item) {
                $func($item);
            }
        };
        $func($this->items);

        return static::make($flat);
    }

    public function all(): array
    {
        return $this->items;
    }

    public function merge($collection)
    {
        $this->items = array_merge(
            $this->items,
            static::make($collection)->all()
        );

        return $this;
    }

    public function shuffle()
    {
        $n = $this->count();
        if ($n < 2) {
            return $this;
        }

        // Let's do the Fisher–Yates shuffle!
        for ($i = 0; $i < $n - 2; $i++) {
            $rand_idx = random_int($i, $n - 1);
            // Swap values with index at $i
            $rand_val = $this->items[$rand_idx];
            $this->items[$rand_idx] = $this->items[$i];
            $this->items[$i] = $rand_val;
        }

        return $this;
    }
}