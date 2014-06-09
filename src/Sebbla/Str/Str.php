<?php

namespace Sebbla\Str;

class Str
{

    private $s;
    private $encoding;

    function __construct($s, $encoding = "UTF-8")
    {
        $this->s = $s;
        $this->encoding = $encoding;
    }

    public function __toString()
    {
        return (string) $this->s;
    }

    public function upper()
    {
        return new Str(\mb_strtoupper($this->s));
    }

    public function lower()
    {
        return new Str(\mb_strtolower($this->s));
    }

    public function add(Str $s2)
    {
        return new Str($this->s . $s2);
    }

}
