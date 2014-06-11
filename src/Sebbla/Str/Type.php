<?php

namespace Sebbla\Str;

abstract class Type
{

    protected $s;
    protected $sAsArray;

    public abstract function asArray();
}
