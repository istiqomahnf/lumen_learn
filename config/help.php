<?php 
    
    //create due date
    $today = date('Y-m-d');
    $duedate = strtotime("+7 day", time());
    $duedate = date('Y-m-d', $duedate);


    //percentage setting
    $percentage = 10.00;
    $prc = 1 + ((float)$percentage/100);
    return[
        'TAXRATE'   => $percentage,
        'PERCENTAGE'=> $prc,
        'DUE_DATE'  => $duedate,
        'EMAIL_FROM'=> 'istiqomah2018@gmail.com',
        'EMAIL_NAME'=> 'Qoqom',
    ];
?>