<?php

namespace Tcrowd\api;

include("config.php");
include("../src/sat.php");
include("../src/nuSMV.php");

use Tcrowd\src\Sat;
use Tcrowd\src\NuSMV;

$reasoner = 'NuSMV';
if (array_key_exists('reasoner',$_REQUEST)){
    $reasoner = $_REQUEST['reasoner'];
}

if ( ! array_key_exists('json', $_POST)){
    echo "I can not find any \"json\" parameter :-(";
}else{

    switch ($reasoner) {
      case 'NuSMV':
          $solver = new NuSMV();
        break;

      default:
          $solver = new NuSMV();
        break;
    }

    $sat = new Sat($solver);
    $ans = $sat->check_sat($_POST['json']);
    print_r($ans);
}
?>
