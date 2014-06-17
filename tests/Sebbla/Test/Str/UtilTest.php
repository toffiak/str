<?php

namespace Sebbla\Test\Str;

use Sebbla\Str\Util;

class UtilTest extends \PHPUnit_Framework_TestCase
{

    public function testArrayInsert()
    {
        $a1 = array(0, 1, 3, 4);
        $this->assertSame(array(0, 1, 2, 3, 4), Util::arrayInsert($a1, array(2), 2));
    }

}
