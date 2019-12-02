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
include("../api/connector.php");
include("../src/sat.php");
include("../src/nuSMV.php");

//use Tcrowd\api\Connector;
use Tcrowd\src\Sat;
use Tcrowd\src\NuSMV;
use PHPUnit\Framework\TestCase;


class SatTest extends TestCase
{

    public function testNuSMVSAT(){

        $json_str = "a";

        $solver = new NuSMV();

        $t_crowd = new Sat($solver);

        $ans = $t_crowd->check_sat($json_str,'NuSMV', 'Entity');

        print_r($ans);

        /*$expected = process_xmlspaces($expected);
        $actual = process_xmlspaces($actual);
        $this->assertEqualXMLStructure($expected, $actual, true);*/
    }
}
