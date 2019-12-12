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
include("connector.php");

use Tcrowd\src\Connector;

class Encode {

    protected $connector = null;

    function __construct(){
      $this->connector = new Connector();
    }

    function getCurrentConnector(){
      return $this->connector;
    }

    /**
       Encoding the diagram represented in JSON format.

       @param $json_str A String with the diagram in JSON format.
       @param $data_str A String with temporal data in JSON format.
       @param $encoding A String with the encode name (tdllitefpx|qtlz|qtlN,ltl).

       @return an answer object.
     */
    function encode($json_str, $data_str, $encoding = 'tdllitefpx', $query = ""){

        $this->connector->run($json_str, $data_str, $encoding, $query);
        $answer = $this->connector->get_answer();

		    return $answer;
    }
}

?>
