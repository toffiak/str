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
        $s3 = new Str('lona gęś');
        $this->assertSame(true, $s2->contains($s3));
    }

    public function testEqual()
    {
        $s1 = new Str('Ala ma kota');
        $s2 = new Str('Ala ma kota');
        $this->assertSame(true, ($s1 == $s2));
        $this->assertSame(false, ($s1 === $s2));
    }

    public function testCapitalize()
    {
        $s1 = new Str("łódka PodwoDNA");
        $this->assertEquals('Łódka podwodna', $s1->capitalize());
        $s2 = new Str("ó");
        $this->assertEquals('Ó', $s2->capitalize());
        $s3 = new Str("");
        $this->assertEquals('', $s3->capitalize());
    }

}
