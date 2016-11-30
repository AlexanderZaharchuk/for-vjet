<?php

namespace frontend\helpers;

class CommonHelper
{
    public static function readAllRecords($rows, $limiter = false)
    {
        $result = [];
        while (false != $record = $rows->fetch_assoc()) {
            (isset($record['text']) && $limiter) ? $record['text'] = self::getNiceSubStr($record['text'], 100)."..." : null;
            $result[] = $record;
        }

        return $result;
    }

    public static function getNiceSubStr($str, $len, $chr = ' ')
    {
        $str .= ' ';
        return mb_substr($str, 0, mb_strpos($str, $chr, mb_strlen($str) < $len ? mb_strlen($str) - 1 : $len));
    }
}
