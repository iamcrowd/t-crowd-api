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
//include("../api/connector.php");
include("../src/encode.php");

use Tcrowd\api\Connector;
use Tcrowd\src\Encode;
use PHPUnit\Framework\TestCase;


class EncodeTest extends TestCase
{

    public function testEncodeDlLiteFpx(){

        $json_str = "a";

        $t_crowd = new Encode();

        $ans = $t_crowd->encode($json_str,'tdllitefpx');

        print_r($ans);

        /*$actual = $racer->get_col_answers()[0];

        $expected = process_xmlspaces($expected);
        $actual = process_xmlspaces($actual);
        $this->assertEqualXMLStructure($expected, $actual, true);*/
    }
}
