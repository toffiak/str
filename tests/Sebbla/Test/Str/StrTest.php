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

    public function testLen()
    {
        $s1 = new Str("Foo");
        $this->assertSame(3, $s1->len());
        $s2 = new Str("Roślina lecznicza: rzeżucha");
        $this->assertSame(27, $s2->len());
    }

    public function testCenter()
    {
        $s1 = new Str('foo');
        $this->assertEquals('foo', $s1->center());
        $this->assertEquals('foo', $s1->center(2));
        $this->assertEquals('-foo', $s1->center(4, '-'));
        $this->assertEquals('####foo###', $s1->center(10, '#'));
    }

    public function testAsArray()
    {
        $s1 = new Str("Grzegorz Brzęczyszczykiewicz");
        $expectedS1 = array('G', 'r', 'z', 'e', 'g', 'o', 'r', 'z', ' ', 'B', 'r', 'z', 'ę', 'c', 'z', 'y', 's', 'z', 'c', 'z', 'y', 'k', 'i', 'e', 'w', 'i', 'c', 'z');
        $this->assertSame($expectedS1, $s1->asArray());
        $s2 = new Str("火车票");
        $expectedS2 = array('火', '车', '票');
        $this->assertSame($expectedS2, $s2->asArray());
        $s3 = new Str("");
        $expectedS3 = array();
        $this->assertSame($expectedS3, $s3->asArray());
    }

    public function testSlice()
    {
        $s1 = new Str("Grzegorz Brzęczyszczykiewicz");
        $this->assertEquals("Grzegorz Brzę", $s1->slice(null, 13));
        $this->assertEquals("rzę", $s1->slice(10, 13));
        $this->assertEquals("r rgzG", $s1->slice(10, null, -2));
    }

    public function testEndsWith()
    {
        $s1 = new Str("Grzegorz Brzęczyszczykiewicz");
        $this->assertSame(true, $s1->endsWith("wicz"));
        $this->assertSame(true, $s1->endswith("rzę", 10, 13));
        $this->assertSame(true, $s1->endsWith("ykiew", 20, -3));
    }

    public function testExpandTabs()
    {
        $s = <<<TEXT
class Foo:
\tdef __init__():
\t\tpass
\tdef setage(self, age):
\t\tif age > 0:
\t\t\tself.age = age
\t\telse
\t\t\tage= None
        
def bar():
\tpass
        
if __name__ == '__main__':
\tbar()
TEXT;
        $expected = <<<TEXT
class Foo:
    def __init__():
        pass
    def setage(self, age):
        if age > 0:
            self.age = age
        else
            age= None
        
def bar():
    pass
        
if __name__ == '__main__':
    bar()
TEXT;
        $s1 = new Str($s);
        $sExpanded = $s1->expandTabs();
        $this->assertEquals($expected, $sExpanded);
    }

    public function testFind()
    {
        $s = new Str('Piórnik z temperówką');
        $this->assertSame(16, $s->find('ów'));
        $this->assertSame(16, $s->find('ów', -6));
        $this->assertSame(-1, $s->find('ów', -3));
        $this->assertSame(2, $s->find('órnik', 2));
        $this->assertSame(-1, $s->find('órnik', 3));
        $this->assertSame(6, $s->find('k z', 5, 12));
        $this->assertSame(6, $s->find('k z', 5, 99));
        $this->assertSame(-1, $s->find('k z', 5, 7));
        $this->assertSame(6, $s->find('k z', 5, -7));
        $this->assertSame(6, $s->find('k z', -15, -11));
    }

    public function testZfill()
    {
        $s = new Str('Pinokio');
        $this->assertEquals('Pinokio', $s->zfill(-1));
        $this->assertEquals('Pinokio', $s->zfill(7));
        $this->assertEquals('0Pinokio', $s->zfill(8));
        $this->assertEquals('000Pinokio', $s->zfill(10));
    }

    public function testTitle()
    {
        $s = new Str('żaba w jeziorze pływa ładnIE');
        $this->assertEquals('Żaba W Jeziorze Pływa Ładnie', $s->title());
    }

    public function testSwapcase()
    {
        $s = new Str('MałY saMOChÓd');
        $this->assertEquals('mAŁy SAmocHóD', $s->swapcase());
    }

}
