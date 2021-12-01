<?php

function to_date_format($date) {
    if ($date) {
        $date = str_replace('/', '-', $date);        
        return date('Y-m-d', strtotime($date));
    } else {
        return NULL;
    }
}

function get_date_diff($from_date,$to_date){
    
    
}

