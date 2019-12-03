<?php
/*

   Copyright 2019

   Author: gab

   connector.php

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tcrowd\src;

include("../api/config.php");
include("../src/solver.php");

use Tcrowd\src\Solver;

class NuSMV extends Solver{

    /**
       The t-crowd command to execute with all its parameters.
       ./NuSMV -bmc -bmc_length bound path_to_file.smv
     */
    const PROGRAM_CMD = "NuSMV";
    const PROGRAM_PARAMS = "-bmc -bmc_length 11";
    protected $answer = [];

    function __construct(){
      $this->answer = [];
    }

    function getSolverNick(){
      return 'NuSMV';
    }

    function get_answer(){
      return $this->answer;
    }

    function saveToFile($tmpfolder){
      $out_name = "reasoner_out.txt";
      $file_out_path = $tmpfolder . $out_name;
      $out_file = fopen($file_out_path, "w");
      fwrite($out_file, join($this->answer));
      fclose($out_file);
    }

    /**
       Execute t_crowd with the given $document as input.
     */
    function run($folder){
      $t_crowd = "";
      $solver_path = $GLOBALS['config']['nusmv_path'];

      $t_crowd .= $solver_path . NuSMV::PROGRAM_CMD . " " . NuSMV::PROGRAM_PARAMS . " ";
      $commandline = $t_crowd . $folder . "*.smv";

      exec($commandline, $this->answer);
      $this->saveToFile($folder);
    }

}

?>
