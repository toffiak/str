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
        return new Str(\strtoupper($this->s));
    }

}
