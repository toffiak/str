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
    
    public function testContais()
    {
        $s1 = new Str('Ala ma kota');
        $this->assertSame(true, $s1->contains('la'));
        $s2 = new Str('Zielona gęśk');
        $this->assertSame(true, $s2->contains('ęś'));
//        $s2 = new Str(' Piłsudski');
    }

}
