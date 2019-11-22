<?php
/*

   Copyright 2019

   Author: gab

   connectortest.php

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

include("../api/config.php");
include("../src/connector.php");

use Tcrowd\src\Connector;
use PHPUnit\Framework\TestCase;

class ConnectorTest extends TestCase
{

  public function testConnector(){

      $t_crowd = new Connector();

      $t_crowd->run('{"entities": [{"name":"Entity","id":"c45", "timestamp": "", "position":{"x":470,"y":250}}],"attributes":[{"name":"A","type":"normal","datatype":"Integer","id":"c57", "timestamp": "", "position":{"x":327,"y":260}}],"relationships":[],"links":[{"name":"c70","entity": "Entity", "attribute": "A","type":"attribute"}]}','tdllitefpx');

      return $t_crowd->get_answer();
  }

}
