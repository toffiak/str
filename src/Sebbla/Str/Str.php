<?php

namespace Sebbla\Str;

class Str implements \Countable
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
        return new Str(\mb_strtoupper($this->s, $this->encoding));
    }

    public function lower()
    {
        return new Str(\mb_strtolower($this->s, $this->encoding));
    }

    public function add(Str $s2)
    {
        return new Str($this->s . $s2);
    }

    public function contains($s)
    {
        if (true == \strpos($this->s, $s)) {
            return true;
        }

        return false;
    }

    public function count()
    {
        return \mb_strlen($this->s, $this->encoding);
    }

    /**
     * Proxy method for count() method.
     * 
     * @return inetegr
     */
    public function len()
    {
        return $this->count();
    }

}
