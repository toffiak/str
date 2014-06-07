<?php

namespace Sebbla\Str;

class Str
{

    private $s;

    function __construct($s)
    {
        $this->s = $s;
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
