<?php

namespace Tcrowd\api;

include("config.php");
include("../src/sat.php");
include("../src/nuSMV.php");

use Tcrowd\src\Sat;
use Tcrowd\src\NuSMV;

$reasoner_sett = 'BMC';
if (array_key_exists('reasoner_sett',$_REQUEST)){
    $reasoner_sett = $_REQUEST['reasoner_sett'];
}

$ltl = "LTL";
if (array_key_exists('ltl',$_REQUEST)){
    $ltl = $_REQUEST['ltl'];
}

if ( ! array_key_exists('json', $_POST)){
    echo "I can not find any \"model\" parameter :-(";
}else{

    if ( ! array_key_exists('data', $_POST)){
      echo "I can not find any \"data\" parameter :-(";
    }else{
      $solver = new NuSMV($reasoner_sett);
      $sat = new Sat($solver);
      $ans = $sat->check_sat($_POST['json'], $_POST['data']);

    /*$command = "";
    $command .= "latex2html " . $ans . "*.tex";
    exec($command);*/

    print_r($ans);
  }
}
?>
