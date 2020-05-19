<?php
/*

   Copyright 2019

   Author: gab

   sat.php

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
include("encode.php");

use Tcrowd\src\Encode;

class Sat {

    protected $solver = null;
    protected $answer = null;

    function __construct($solver){
      $this->solver = $solver;
      $this->answer = null;
    }

    function getSolver(){
      return $this->solver;
    }

    function getSatAnswer(){
      return $this->answer;
    }

    /**
       Check the diagram represented in JSON format for satisfiability. Reasoner output is saved
       into the protected var $answer.

       @param $json_str A String with the diagram in JSON format.
       @param $data_str A String with temporal data in JSON format.
       @param $query A String with the query. If query is the empty string, KB is checked for satisfiability.
       If query is not empty, the entity consistency service is executed.
       @param $command A string with the command to run t-crowd-lib

       @return temporal path to output file.
     */
    function check_sat($json_str, $data_str){

        //$format = $this->getSolver()->getSolverNick();
        $encoding = new Encode();
        $encoding->encode($json_str, $data_str);
        $tmpFolderSolver = $encoding->getCurrentConnector()->getCurrentTmpFolder();
        $this->getSolver()->run($tmpFolderSolver);
        $this->answer = $this->getSolver()->get_answer();

		    return $tmpFolderSolver;
    }
}

?>
