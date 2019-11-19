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

namespace Tcrowd\api;

include("../api/config.php");
include("../api/connector.php");

use Tcrowd\api\Connector;
use PHPUnit\Framework\TestCase;

class ConnectorTest extends TestCase
{

    public function testConnector(){

        $t_crowd = new Connector();
        //print_r($t_crowd);

        $t_crowd->run("a",'tdllitefpx');

        return $t_crowd->get_answers();

        /*$actual = $racer->get_col_answers()[0];

        $expected = process_xmlspaces($expected);
        $actual = process_xmlspaces($actual);
        $this->assertEqualXMLStructure($expected, $actual, true);*/
    }
}
