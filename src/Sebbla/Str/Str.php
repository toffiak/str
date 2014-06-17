<?php

namespace Sebbla\Str;

use Sebbla\Str\Type;
use Sebbla\Str\Slice;

class Str extends Type
{

    private $encoding;

    function __construct($s, $encoding = "UTF-8")
    {
        $this->encoding = $encoding;
        $this->s = ( $this->encoding === \mb_detect_encoding($s) ) ? $s : \mb_convert_encoding($s, $encoding);
    }

    public function __toString()
    {
        return (string) $this->s;
    }

    /**
     * Returnign raw value.
     * 
     * @return mixed
     */
    public function getRaw()
    {
        return $this->s;
    }

    /**
     * Copy and uppercase string.
     *  
     * @return \Sebbla\Str\Str
     */
    public function upper()
    {
        return new Str(\mb_strtoupper($this->s, $this->encoding));
    }

    /**
     * Copy and lowercase string.
     * 
     * @return \Sebbla\Str\Str
     */
    public function lower()
    {
        return new Str(\mb_strtolower($this->s, $this->encoding));
    }

    /**
     * Adding two string.
     * 
     * @param \Sebbla\Str\Str $s2
     * @return \Sebbla\Str\Str
     */
    public function add(Str $s2)
    {
        return new Str($this->s . $s2);
    }

    /**
     * Checking if string contains string.
     * 
     * @param string|\Sebbls\Str\Str $s
     * @return boolean
     */
    public function contains($s)
    {
        if ($s instanceof \Sebbla\Str\Str) {
            $s = $s->getRaw();
            if (true == \strpos($this->s, $s)) {
                return true;
            }
        }
        if (true == \strpos($this->s, $s)) {
            return true;
        }

        return false;
    }

    /**
     * Counting number of chars in string.
     * 
     * @return integer
     */
    public function len()
    {
        return \mb_strlen($this->s, $this->encoding);
    }

    /**
     * Capitalizing string, first char uppercase rest lowercase.
     * 
     * @return \Sebbla\Str\Str
     */
    public function capitalize()
    {
        return new Str(
                \mb_strtoupper(\mb_substr($this->s, 0, 1, $this->encoding), $this->encoding) .
                \mb_strtolower(\mb_substr($this->s, 1, $this->len(), $this->encoding), $this->encoding)
        );
    }

    /**
     * Centering string.
     * 
     * @param integer $width
     * @param char $fillchar
     * @return \Sebbla\Str\Str
     */
    public function center($width = 0, $fillchar = ' ')
    {
        if ($width <= \mb_strlen($this->s)) {
            return new Str($this->s);
        }
        $newString = $this->s;
        $missingChars = $width - $this->len();
        $left = \round($missingChars / 2);
        $right = $missingChars - $left;
        for ($i = 0; $i < $left; $i++) {
            $newString = $fillchar . $newString;
        }
        for ($j = 0; $j < $right; $j++) {
            $newString.= $fillchar;
        }

        return new Str($newString, $this->encoding);
    }

    /**
     * Returning string as array.
     * 
     * @return array
     */
    public function asArray()
    {
        if (null === $this->sAsArray) {
            $this->sAsArray = \preg_split('/(?<!^)(?!$)/u', $this->s, null, PREG_SPLIT_NO_EMPTY);
        }

        return $this->sAsArray;
    }

    /**
     * Slicing string and returning new instance of class Str
     * 
     * @param null|integer $start
     * @param null|integer $stop
     * @param integer $step
     * @return \Sebbla\Str\Str
     */
    public function slice($start = null, $stop = null, $step = 1)
    {
        $slice = new Slice($this->asArray(), $start, $stop, $step);
        $sliced = $slice->slice();

        return new Str(\join('', $sliced), $this->encoding);
    }

    /**
     * Checking if string ends with a given suffix.
     * 
     * @param string $suffix
     * @param integer $start
     * @param null|integer $end
     * @return boolean
     */
    public function endsWith($suffix, $start = 0, $end = null)
    {
        $sliced = $this->slice($start, $end);

        return $suffix === "" || \mb_substr($sliced, - \mb_strlen($suffix, $this->encoding), \mb_strlen($sliced, $this->encoding), $this->encoding) === $suffix;
    }

    public function expandTabs($tabSize = 4)
    {
        if ($tabSize < 1) {
            return new Str($this->s, $this->encoding);
        }

        // Creating and filling insert array
        $insert = array();
        for ($j = 0; $j < $tabSize; $j++) {
            $insert[] = ' ';
        }

        $asArray = $this->asArray();
        $len = count($asArray);
        for ($i = 0; $i < $len; $i++) {
            if ($asArray[$i] === "\t") {
                unset($asArray[$i]);
                $len+=($tabSize - 1);
                \Sebbla\Str\Util::arrayInsert(&$asArray, $insert, $i);
            }
        }

        return new Str(\join('', $asArray), $this->encoding);
    }

    public function find($sub, $start = 0, $end = null)
    {
        $slicedString = $this->slice($start, $end);
        $subPositionInSlice = \strpos($slicedString, $sub);
        if ($subPositionInSlice === false) {
            return -1;
        }
        $position = $start < 0 ? $this->len() + $start + $subPositionInSlice : $start + $subPositionInSlice;

        return $position;
    }

}
