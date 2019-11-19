<?php

namespace Tcrowd\api;

include("config.php");
include("../src/encode.php");

use Tcrowd\src\Encode;

$formal = 'tdllitefpx';
if (array_key_exists('formal',$_REQUEST)){
    $formal = $_REQUEST['formal'];
}

if ( ! array_key_exists('json', $_POST)){
    echo "I can not find any \"json\" parameter :-(";
}else{

    $encoding = "";
    $encoding = new Encode();
    $ans = $encoding->encode($_POST['json'], $formal);
    print_r($ans);

}
?>
