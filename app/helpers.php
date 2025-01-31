<?php
/*
    ! : Do not forget to run the following command after modification
    ? : composer dump-autoload
*/

function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}

function limitStr($field, $limit){
    return Str::limit($field, $limit);
}

function changeDateFormat1($date){
    return \Carbon\Carbon::parse($date)->isoFormat('MMM D YYYY, h:mm a');
}

?>