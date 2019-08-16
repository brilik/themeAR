<?php


class DebugAR
{
    /**
     * Dump and Die. Show stylized array. Search by word "Hello".
     * @param $arr
     */
    static public function dd($arr, $textColor = 'darkred', $bgcolor = '')
    {
        echo "\n <br>";
        echo "Hello Dump Array:";
        echo "<pre style='color:".$textColor."; background-color:".$bgcolor."'>";
        var_dump($arr);
        echo "</pre>";
        die('_______End_______');
    }


    /**
     * Show variable with help stylized print_r. Search by word "Hello".
     * @param $var
     */
    static public function pr($var, $textColor = 'darkred', $bgcolor = '')
    {
        echo "\n <br>";
        echo "Hello Print_R:";
        echo "<pre style='color:".$textColor."; background-color:".$bgcolor."'>";
        print_r($var);
        echo "</pre>";
    }
}