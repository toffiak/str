<?php

namespace Sebbla\Str;

use Sebbla\Str\Type;
use Sebbla\Str\Slice;

class Str extends Type
{

    /**
     * Encoding type.
     * 
     * @var string 
     */
    private $encoding;

    function __construct($s, $encoding = "UTF-8")
    {
	// Useless commit
        $this->encoding = $encoding;
        $this->s = (string) ( $this->encoding === \mb_detect_encoding($s) ) ? $s : \mb_convert_encoding($s, $encoding);
    }

    /**
     * Human readable string.
     * 
     * @return string
     */
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
     * Checking if a given string is PHP native string.
     * 
     * @param  string|\Sebbl\Str\Str $s
     * @return boolean
     */
    protected function isNativeString($s)
    {
        return $s instanceof \Sebbla\Str\Str ? false : true;
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
     * @param string|\Sebbl\Str\Str $s
     * @return boolean
     */
    public function contains($s)
    {
        if (!$this->isNativeString($s)) {
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
     * Checking if two strings are same.
     * 
     * @param string|\Sebbls\Str\Str $s
     * @return boolean
     */
    public function eq($s)
    {
        $sRaw = !$this->isNativeString($s) ? $s->getRaw() : $s;

        return \strcmp($this->getRaw(), $sRaw) == 0 ? true : false;
    }

    /**
     * Checking if first string is equal or greater then second one.
     * 
     * @param string|\Sebbls\Str\Str $s
     * @return boolean
     */
    public function ge($s)
    {
        $sRaw = !$this->isNativeString($s) ? $s->getRaw() : $s;

        return \strcmp($this->getRaw(), $sRaw) >= 0 ? true : false;
    }

    /**
     * Checking if first string is greater then second one.
     * 
     * @param string|\Sebbls\Str\Str $s
     * @return boolean
     */
    public function gt($s)
    {
        $sRaw = !$this->isNativeString($s) ? $s->getRaw() : $s;

        return \strcmp($this->getRaw(), $sRaw) > 0 ? true : false;
    }

    /**
     * Checking if first string is equal or less than second one.
     * 
     * @param string|\Sebbls\Str\Str $s
     * @return boolean
     */
    public function le($s)
    {
        $sRaw = !$this->isNativeString($s) ? $s->getRaw() : $s;

        return \strcmp($this->getRaw(), $sRaw) <= 0 ? true : false;
    }

    /**
     * Checking if first string is less than second one.
     * 
     * @param string|\Sebbls\Str\Str $s
     * @return boolean
     */
    public function lt($s)
    {
        $sRaw = !$this->isNativeString($s) ? $s->getRaw() : $s;

        return \strcmp($this->getRaw(), $sRaw) < 0 ? true : false;
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
        $subPositionInSlice = \mb_strpos($slicedString, $sub, null, $this->encoding);
        if ($subPositionInSlice === false) {
            return -1;
        }
        $position = $start < 0 ? $this->len() + $start + $subPositionInSlice : $start + $subPositionInSlice;

        return $position;
    }

    /**
     * Adding additional zeros before string.
     * 
     * @param integer $width
     * @return \Sebbla\Str\Str
     */
    public function zfill($width)
    {
        $width = (int) $width;
        if ($this->len() >= $width) {
            return new Str($this->s, $this->encoding);
        }
        $asArray = $this->asArray();
        $arrayOfZeros = array_fill(0, $width - $this->len(), 0);
        \Sebbla\Str\Util::arrayInsert(&$asArray, $arrayOfZeros, 0);

        return new Str(\join('', $asArray), $this->encoding);
    }

    /**
     * Returning titlecased version of a given string.
     * 
     * @return \Sebbla\Str\Str
     */
    public function title()
    {
        return new Str(\mb_convert_case($this->s, \MB_CASE_TITLE, $this->encoding), $this->encoding);
    }

    /**
     * Returning string with all upper characters converted to lowercase and vice versa.
     * 
     * @return \Sebbla\Str\Str
     */
    public function swapcase()
    {
        $asArray = $this->asArray();
        $swapcased = array();
        for ($i = 0; $i < $this->len(); $i++) {
            $swapcased[$i] = \mb_strtolower($asArray[$i], $this->encoding) != $asArray[$i] ?
                    \mb_strtolower($asArray[$i], $this->encoding) :
                    \mb_strtoupper($asArray[$i], $this->encoding);
        }

        return new Str(\join('', $swapcased), $this->encoding);
    }

    /**
     * Returning string with removed whitespaces from beginning and end of string
     * 
     * @return \Sebbla\Str\Str
     */
    public function strip()
    {
        return new Str(\trim($this->s), $this->encoding);
    }

    /**
     * Checking if all characters in string are uppercase.
     * 
     * @return boolean
     */
    public function isupper()
    {
        return 0 === \strcmp(\mb_strtoupper($this->s, $this->encoding), $this->s) ? true : false;
    }

    /**
     * Checking if all characters in string are lowercase.
     * 
     * @return boolean
     */
    public function islower()
    {
        return 0 === \strcmp(\mb_strtolower($this->s, $this->encoding), $this->s) ? true : false;
    }

}
