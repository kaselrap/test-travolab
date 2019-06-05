<?php

namespace App\Services;

/**
 * Class Debug
 * @package App\Services
 */
class Debug
{
    /**
     *
     */
    public static function showQueryLogs()
    {
        \DB::listen(function ($query) {
            $replace = function ($sql, $bindings) {
                $needle = '?';
                foreach ($bindings as $replace) {
                    $pos = strpos($sql, $needle);
                    if ($pos !== false) {
                        if (gettype($replace) === "string") {
                            $replace = ' "' . addslashes($replace) . '" ';
                        } elseif ($replace instanceof \DateTime) {
                            $replace = ' "' . addslashes($replace->format('Y-m-d')) . '" ';
                        }
                        $sql = substr_replace($sql, $replace, $pos, strlen($needle));
                    }
                }
                return $sql . PHP_EOL;
            };

            dump($replace($query->sql, $query->bindings) . PHP_EOL);
        });
    }
}