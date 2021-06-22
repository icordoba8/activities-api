<?php

if (! function_exists('add_hours')) {
    function add_hours($times)
    {  
        $hours = 0;
        if(count($times)){
            foreach ($times as $time) {
               $hours +=$time->hours;
            }
        }
        return $hours;
    }
}