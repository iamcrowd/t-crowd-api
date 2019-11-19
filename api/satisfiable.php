<?php

namespace Tcrowd\api;

include("config.php");
include("connector.php");

$reasoner = 'NuSMV';
if (array_key_exists('reasoner',$_REQUEST)){
    $reasoner = $_REQUEST['reasoner'];
}

if ( ! array_key_exists('json', $_POST)){
    echo "I can not find any \"json\" parameter :-(";
}else{

    $sat = "";
    $sat = new Sat();
    $ans = $sat->check_sat($_POST['json'], $reasoner);
    print_r($ans);
    
}
?>
