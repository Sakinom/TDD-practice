<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/Dollar.php';

class MoneyTest extends TestCase
{
  public function testMultiplication()
  {
      $five = new Dollar(5);
      $five->times(2);
      $this->assertEquals(10, $five->amount);
  }
}
