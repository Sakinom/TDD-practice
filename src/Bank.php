<?php

class Bank
{
  private array $rates = [];

  public function reduce(Expression $source, string $to): Money
  {
    return $source->reduce($this, $to);
  }

  public function addRate(string $from, string $to, int $rate)
  {
    $this->rates[$from . $to] = $rate;
  }

  public function rate(string $from, string $to): int
  {
    return $from === $to ? 1 : $this->rates[$from . $to];
  }
}