<?php

namespace Sebbla\Test\Str;

use Sebbla\Str\Str;

class StrTest extends \PHPUnit_Framework_TestCase
{

    public function testUpper()
    {
        $s = new Str('ęóąśłżźćń');
        $this->assertEquals('ĘÓĄŚŁŻŹĆŃ', $s->upper());
    }

    public function testLower()
    {
        $s = new Str('ĘÓĄŚŁŻŹĆŃ');
        $this->assertEquals('ęóąśłżźćń', $s->lower());
    }

    public function testAdd()
    {
        $s1 = new Str('Józef');
        $s2 = new Str(' Piłsudski');
        $this->assertEquals('Józef Piłsudski', $s1->add($s2));
    }

    public function testContains()
    {
        $s1 = new Str('Ala ma kota');
        $this->assertSame(true, $s1->contains('la'));
        $s2 = new Str('Zielona gęś');
        $this->assertSame(true, $s2->contains('ęś'));
    }

    public function testEqual()
    {
        $s1 = new Str('Ala ma kota');
        $s2 = new Str('Ala ma kota');
        $this->assertSame(true, ($s1 == $s2));
        $this->assertSame(false, ($s2 === $s2));
    }

}
