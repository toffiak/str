<?php

namespace Sebbla\Str;

interface Sliceable
{

    /**
     * Slice structure
     * 
     * @param type $start
     * @param type $end
     * @param type $step
     */
    public function slice($start = 0, $end = null, $step = 1);
}
