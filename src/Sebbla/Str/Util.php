<?php

namespace Sebbla\Str;

class Util
{

    /**
     * http://blog.leenix.co.uk/2010/03/php-insert-into-middle-of-array.html
     * 
     * @param type $array
     * @param type $insert
     * @param type $position
     */
    public static function arrayInsert(&$array, $insert, $position)
    {
        \settype($array, "array");
        \settype($insert, "array");
        \settype($position, "int");
        if ($position == 0) {
            $array = \array_merge($insert, $array);
        } else {
            if ($position >= (count($array) - 1)) {
                $array = \array_merge($array, $insert);
            } else {
                $head = \array_slice($array, 0, $position);
                $tail = \array_slice($array, $position);
                $array = \array_merge($head, $insert, $tail);
            }
        }
    }

}
