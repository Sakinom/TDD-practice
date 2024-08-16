<?php

namespace App\Phpunit;

use PHPUnit\Framework\TestCase;
use App\Dollar;

class MoneyTest extends TestCase
{
  public function testMultiplication()
  {
      $five = new Dollar(5);
      $five->times(2);
      $this->assertEquals(10, $five->amount);
  }
}
