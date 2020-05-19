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
    protected $sett = "";
    protected $time = "60";
    protected $memory = "1024";

    function __construct($sett, $time, $memory){
      $this->answer = [];
      $this->sett = $sett;
      $this->time = $time;
      $this->memory = $memory;
    }

    function getSolverNick(){
      return 'NuSMV';
    }

    function get_answer(){
      return $this->answer;
    }

    function param(){
      switch ($this->sett) {
        case 'BMC':
            $param = " -bmc -bmc_length 60 ";
          break;
        case 'BDD':
            $param = " -dcx -dynamic ";
        default:
            $param = " -bmc -bmc_length 60 ";
          break;
      }
      return $param;
    }

    /**
      Save reasoner output into a file. Temporal folder is given as input.
    */
    function saveToFile($tmpfolder){
      $out_name = "reasoner_out.txt";
      $file_out_path = $tmpfolder . $out_name;
      $out_file = fopen($file_out_path, "w");
      fwrite($out_file, join($this->answer));
      fclose($out_file);
    }

    /**
       Execute NuSMV and save the results into a temporal file. Temporal directory is given
       as input.
     */
    function run($folder){
      $t_crowd = "";
      $solver_path = $GLOBALS['config']['nusmv_path'];
      $runlim_path = $GLOBALS['config']['runlim_path'];

      $t_crowd .= $solver_path . NuSMV::PROGRAM_CMD . " " . $this->param() . " ";
      $commandline = $runlim_path . "runlim " . "-r" . $this->time . "-s" . $this->memory . $t_crowd . $folder . "*.smv";

      exec($commandline, $this->answer);
      $this->saveToFile($folder);
    }

}

?>
