<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/Money.php';
require_once __DIR__ . '/../../src/Bank.php';
require_once __DIR__ . '/../../src/Sum.php';

class MoneyTest extends TestCase
{
  public function testMultiplication()
  {
    $five =Money::dollar(5);
    $this->assertEquals(Money::dollar(10), $five->times(2));
    $this->assertEquals(Money::dollar(15), $five->times(3));
  }

  public function testEquality()
  {
    $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
    $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
    $this->assertFalse((Money::franc(5))->equals(Money::dollar(5)));
  }

  public function testCurrency()
  {
    $this->assertEquals('USD', Money::dollar(1)->currency());
    $this->assertEquals('CHF', Money::franc(1)->currency());
  }

  public function testSimpleAddition()
  {
    $five = Money::dollar(5);
    $sum = $five->plus($five);
    $bank = new Bank();
    $reduced = $bank->reduce($sum, 'USD');
    $this->assertEquals(Money::dollar(10), $reduced);
  }

  public function testPlusReturnsSum()
  {
    $five = Money::dollar(5);
    $result = $five->plus($five);
    $sum = $result;
    $this->assertEquals($five, $sum->augend);
    $this->assertEquals($five, $sum->addend);
  }

  public function testReduceSum()
  {
    $sum = new Sum(Money::dollar(3), Money::dollar(4));
    $bank = new Bank();
    $result = $bank->reduce($sum, 'USD');
    $this->assertEquals(Money::dollar(7), $result);
  }

  public function testReduceMoney()
  {
    $bank = new Bank();
    $result = $bank->reduce(Money::dollar(1), 'USD');
    $this->assertEquals(Money::dollar(1), $result);
  }
}
