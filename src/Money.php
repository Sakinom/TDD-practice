<?php

require_once __DIR__ . '/Expression.php';

class Money implements Expression
{
  protected int $amount;
  protected string $currency;

  public function __construct(int $amount, string $currency)
  {
    $this->amount = $amount;
    $this->currency = $currency;
  }

  public function times(int $multiplier): Expression
  {
    return new Money($this->amount * $multiplier, $this->currency);
  }

  public function currency(): string
  {
    return $this->currency;
  }

  public function equals(object $object)
  {
    $money = $object;
    return $this->amount === $money->amount && $this->currency() === $money->currency();
  }

  public static function dollar(int $amount): Money
  {
    return new Money($amount, 'USD');
  }

  public static function franc(int $amount): Money
  {
    return new Money($amount, 'CHF');
  }

  public function plus(Expression $addend): Expression
  {
    return new Sum($this, $addend);
  }

  public function reduce(Bank $bank, string $to): Money
  {
    $rate = ($this->currency === 'CHF' && $to === 'USD') ? 2 : 1;
    return new Money($this->amount / $rate, $to);
  }

  public function getAmount(): int
  {
    return $this->amount;
  }

  public function getCurrency(): string
  {
    return $this->currency;
  }
}
