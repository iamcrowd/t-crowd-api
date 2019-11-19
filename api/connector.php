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

namespace Tcrowd\api;

include("config.php");

class Connector {

    /**
       The t-crowd command to execute with all its parameters.
     */
    const PROGRAM_CMD = "java";
    const PROGRAM_PARAMS = "-cp";
    protected $answer = [];

    function __construct(){
        $this->answer = [];
    }

    function get_answer(){
        return $this->answer;
    }

    /**
       Execute t_crowd with the given $document as input.
       java -cp target/dependency/t-crowd-cli-4.0.0-SNAPSHOT.jar it.gilia.tcrowd.cli.TCrowd tdllitefpx -t value.json
     */
    function run($input, $command){
        $t_crowd = "";
        $temporal_path = $GLOBALS['config']['temporal_path'];
        $t_crowd_client = $GLOBALS['config']['t-crowd-client'];
        $class_client = $GLOBALS['config']['t-crowd-main'];

        $uuid = uniqid();

        $temporal_path = realpath($temporal_path) . "/";
        $ervt_name = $uuid . "ervt_model.json";
        $file_path = $temporal_path . $ervt_name;

        $t_crowd .= Connector::PROGRAM_CMD . " " . Connector::PROGRAM_PARAMS . " " . $t_crowd_client . " " . $class_client . " " . $command;
        $commandline = $t_crowd . " -t " . $file_path;

        $ervt_file = fopen($file_path, "w");

        if (! $ervt_file){
            throw new \Exception("Temporal file couldn't be opened for writing...
            Is the path '$file_path' correct?");
        }

        fwrite($ervt_file, $input);
        fclose($ervt_file);

        exec($commandline, $answer_lib);

        unlink($file_path);

        array_push($this->answer, $answer_lib);
    }

    /**
       Check for program and input file existance and proper permissions.

       @return true always
       @exception Exception with proper message if any problem is founded.
    */
    function check_files($temporal_path, $t_crowd_path, $file_path){
        if (! is_dir($temporal_path)){
            throw new \Exception("Temporal path desn't exists!
Are you sure about this path?
temporal_path = \"$temporal_path\"");
        }

        if (!file_exists($file_path)){
            throw new \Exception("Temporal file doesn't exists, please create one at '$file_path'.");
        }

        if (!is_readable($file_path)){
            throw new \Exception("Temporal file cannot be readed.
Please set the write and read permissions for '$file_path'");
        }

        if (file_exists($file_path) and !is_writable($file_path)){
            throw new \Exception("Temporal file is not writable, please change the permissions.
Check the permissions on '${file_path}'.");
        }

        if (!file_exists($t_crowd_path)){
            throw new \Exception("The t_crowd program has not been founded...
You told me that '$t_crowd_path' is the t_crowd program, is this right? check your 'web-src/config/config.php' configuration file.");
        }

        if (!is_executable($t_crowd_path)){
            throw new \Exception("The t_crowd program is not executable...
Is the path '$t_crowd_path' right? Is the permissions setted properly?");
        }

        return true;
    }
}

?>
