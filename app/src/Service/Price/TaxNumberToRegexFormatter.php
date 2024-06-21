<?php

namespace App\Service\Price;

class TaxNumberToRegexFormatter
{

    public function toRegex(string $code)
    {
        $symbols = str_split($code);
        $regex = '';
        $numberPattern = '[0-9]{%d}';
        $letterPattern = '[A-z]{%d}';
        $nCount = 0;
        $lCount = 0;
        foreach ($symbols as $index => $symbol) {
            if($symbol === '\\') continue;

            if($symbol === 'X') {
                if(isset($symbols[$index-1]) && $symbols[$index-1] === '\\') {
                    $regex .= $symbol;
                } else {
                    $nCount++;
                }

                if(!isset($symbols[$index+1]) || $symbols[$index+1] !== 'X') {
                    if($nCount > 0) {
                        $regex .= sprintf($numberPattern, $nCount);
                    }

                    $nCount = 0;
                }

                continue;
            }
            if($symbol === 'Y') {
                if(isset($symbols[$index-1]) && $symbols[$index-1] === '\\') {
                    $regex .= $symbol;
                } else {
                    $lCount++;
                }

                if(!isset($symbols[$index+1]) || $symbols[$index+1] !== 'Y') {
                    if($lCount > 0) {
                        $regex .= sprintf($letterPattern, $lCount);
                    }

                    $lCount = 0;
                }

                continue;
            }

            $regex .= $symbol;
        }

        return '/^' . $regex . '$/';
    }
}
