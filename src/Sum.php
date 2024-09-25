<?php

class Sum implements Expression
{
  public Money $augend;
  public Money $addend;

  public function __construct(Money $augend, Money $addend)
  {
    $this->augend = $augend;
    $this->addend = $addend;
  }

  public function reduce(Bank $bank, string $to): Money
  {
    $amount = $this->augend->getAmount() + $this->addend->getAmount();
    return new Money($amount, $to);
  }
}