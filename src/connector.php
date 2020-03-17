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

include("config.php");

class Connector {

    /**
       The t-crowd command to execute with all its parameters.
     */
    const PROGRAM_CMD = "java";
    const PROGRAM_PARAMS = "-cp";
    protected $answer = [];
    protected $currentTmpFolder = "";

    function __construct(){
        $this->answer = [];
        $this->currentTmpFolder = "";
    }

    function get_answer(){
      return $this->answer;
    }

    function getCurrentTmpFolder(){
      return $this->currentTmpFolder;
    }

    /**
       Execute t_crowd with the given $document as input.
       java -cp target/dependency/t-crowd-cli-4.0.0-SNAPSHOT.jar it.gilia.tcrowd.cli.TCrowd tdllitefpx -t value.json

       @param $input String temporal model
       @param $data String temporal data
       @param $command String command to be executed
       @param $query String query
     */
    function run($input, $data, $command, $query){
        $t_crowd = "";
        $temporal_path = $GLOBALS['config']['public_html'];
        $t_crowd_client = $GLOBALS['config']['t-crowd-client'];
        $class_client = $GLOBALS['config']['t-crowd-main'];

        $uuid = uniqid();

        $temporal_path = realpath($temporal_path) . "/" . $uuid . "/";
        mkdir($temporal_path, 0755);
        $this->currentTmpFolder = $temporal_path;

        $ervt_name = $uuid . "ervt_model.json";
        $file_path = $this->currentTmpFolder . $ervt_name;

        $data_name = $uuid . "temp_data.json";
        $file_path_data = $this->currentTmpFolder . $data_name;

        $t_crowd .= Connector::PROGRAM_CMD . " " . Connector::PROGRAM_PARAMS . " " . $t_crowd_client . " " . $class_client . " " . $command;

        if ($command == "tdllitefpx"){
          $commandline = $t_crowd . " -t " . $file_path . " -a" . $file_path_data;
        }

        if ($command == "TBoxSatNuSMV"){
          $query_name = $uuid . "query.txt";
          $file_query_path = $this->currentTmpFolder . $query_name;
          $query_file = fopen($file_query_path, "w");
          fwrite($query_file, $query);
          fclose($query_file);
          $commandline = $t_crowd . " -t " . $file_path . " -q " . $file_query_path . " -pf ";
        }

        if ($command == "TBoxABoxSatNuSMV"){
          $commandline = $t_crowd . " -t " . $file_path . " -a " . $file_path_data;
        }

        $ervt_file = fopen($file_path, "w");
        $data_file = fopen($file_path_data, "w");

        if (! $ervt_file){
            throw new \Exception("Temporal file couldn't be opened for writing...
            Is the path '$file_path' correct?");
        }

        if (! $data_file){
            throw new \Exception("Temporal data file couldn't be opened for writing...
            Is the path '$file_path_data' correct?");
        }

        fwrite($ervt_file, $input);
        fclose($ervt_file);

        fwrite($data_file, $data);
        fclose($data_file);

        exec($commandline, $answer_lib);

        unlink($file_path);
        unlink($file_path_data);

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
