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

}
