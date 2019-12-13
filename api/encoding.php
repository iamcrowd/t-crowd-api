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

    if ( ! array_key_exists('data', $_POST)){
      echo "I can not find any \"data\" parameter :-(";
    }else{
      $encoding = "";
      $command = "";
      $encoding = new Encode();
      $ans = $encoding->encode($_POST['json'], $_POST['data'], $formal);
      $connectorDir = $encoding->getCurrentConnector()->getCurrentTmpFolder();
      $command .= "latex2html " . $connectorDir . "*.tex";
      exec($command);
      print_r($connectorDir);
  }
}
?>
