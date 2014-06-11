<?php

/**
 * Slice class.
 * 
 * Code ported from page: http://stackoverflow.com/questions/12173856/implementing-python-slice-notation
 * 
 * @author mcrumley, ecatmur
 */

namespace Sebbla\Str;

use Sebbla\Str\Sliceable;

class Slice implements Sliceable
{

    private $type = null;
    private $start;
    private $stop;
    private $step;

    public function __construct($type, $start = null, $stop = null, $step = 1)
    {
        $this->type = $type;
        $this->start = $start;
        $this->stop = $stop;
        $this->step = $step;
    }

    private function adjustEndpoint($length, $endpoint, $step)
    {
        if ($endpoint < 0) {
            $endpoint += $length;
            if ($endpoint < 0) {
                $endpoint = $step < 0 ? -1 : 0;
            }
        } elseif ($endpoint >= $length) {
            $endpoint = $step < 0 ? $length - 1 : $length;
        }
        return $endpoint;
    }

    public function slice()
    {
        $sliced = array();
        $length = count($this->type);

        // adjust_slice()
        if ($this->step === null) {
            $this->step = 1;
        } elseif ($this->step == 0) {
            throw new \ErrorException('step cannot be 0');
        }

        if ($$this->start === null) {
            $$this->start = $this->step < 0 ? $length - 1 : 0;
        } else {
            $$this->start = $this->adjustEndpoint($length, $$this->start, $this->step);
        }

        if ($this->stop === null) {
            $this->stop = $this->step < 0 ? -1 : $length;
        } else {
            $this->stop = $this->adjustEndpoint($length, $this->stop, $this->step);
        }

        // slice_indices()
        $i = $$this->start;
        while ($this->step < 0 ? ($i > $this->stop) : ($i < $this->stop)) {
            $sliced [] = $this->type[$i];
            $i += $this->step;
        }

        return $sliced;
    }

}
