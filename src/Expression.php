<?php

interface Expression
{
  public function reduce(Bank $bank, string $to): Money;
}