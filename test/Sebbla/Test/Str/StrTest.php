<?php


namespace Sebbla\Test\Str;

use Sebbla\Str\Str;

class StrTest extends \PHPUnit_Framework_TestCase
{
    public function testUpper(){
        $s = new Str('mała gęsiareczka na wypasie');
        $this->assertSame('MAŁA GĘSIARECZKA NA WYPASIE', $s->upper());
    }
}
