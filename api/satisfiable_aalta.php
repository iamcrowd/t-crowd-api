<?php

namespace Tcrowd\api;

include("config.php");
include("../src/sat.php");
include("../src/nuSMV.php");

use Tcrowd\src\Sat;
use Tcrowd\src\NuSMV;

$reasoner = 'TBoxSatNuSMV';
if (array_key_exists('reasoner',$_REQUEST)){
    $reasoner = $_REQUEST['reasoner'];
}

$query = '';
if (array_key_exists('query',$_REQUEST)){
    $query = $_REQUEST['query'];
}

if ( ! array_key_exists('json', $_POST)){
    echo "I can not find any \"model\" parameter :-(";
}else{

    if ( ! array_key_exists('data', $_POST)){
      echo "I can not find any \"data\" parameter :-(";
    }else{
      switch ($reasoner) {
        case 'TBoxSatNuSMV':
          $solver = new NuSMV();
        break;

        default:
          $solver = new NuSMV();
        break;
      }

      $sat = new Sat($solver);
      $ans = $sat->check_sat($_POST['json'], $_POST['data'], $_POST['query'], $reasoner);

    /*$command = "";
    $command .= "latex2html " . $ans . "*.tex";
    exec($command);*/

    print_r($ans);
  }
}
?>
