<?php

namespace Tcrowd\api;

include("config.php");
include("../src/encode.php");

use Tcrowd\src\Encode;

/**
@// TODO: return link or result must be refactored.
*/
$formal = 'tdllitefpx';
if (array_key_exists('formal',$_REQUEST)){
    $formal = $_REQUEST['formal'];
}

if ( ! array_key_exists('json', $_POST)){
    echo "I can not find any \"json\" parameter :-(";
}else{

    $encoding = "";
    $command = "";
    $encoding = new Encode();
    $ans = $encoding->encode($_POST['json'], $formal);
    $command .= "latex2html " . "./tdl2TDLLiteFPX_tbox.tex";
    exec($command);
    print_r($ans);

}
?>
