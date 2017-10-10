<?php

/*DEFINE CONSTANTS*/
define('INPUT_FOLDER',    './subtitle_input/');
define('OUTPUT_FOLDER',  './subtitle_output/');
define('SRT_STATE_SUBNUMBER',               0);
define('SRT_STATE_TIME',                    1);
define('SRT_STATE_TEXT',                    2);
define('SRT_STATE_BLANK',                   3);

/*CREATE FOLDERS IF NONE FOUND*/
if (!file_exists(INPUT_FOLDER)) {
    mkdir(INPUT_FOLDER, 0777, true);
}

if (!file_exists(OUTPUT_FOLDER)) {
    mkdir(OUTPUT_FOLDER, 0777, true);
}

/*READ SINGLE SUBTITLE FILE*/
function read_subtitles($path = NULL){

    if($path === NULL){
        return;
    }
    
    $lines   = file($path);
    
    $subs    = array();
    $state   = SRT_STATE_SUBNUMBER;
    $subNum  = 0;
    $subText = '';
    $subTime = '';
    
    foreach($lines as $line) {
        switch($state) {
            case SRT_STATE_SUBNUMBER:
                $subNum = trim($line);
                $state  = SRT_STATE_TIME;
                break;
    
            case SRT_STATE_TIME:
                $subTime = trim($line);
                $state   = SRT_STATE_TEXT;
                break;
    
            case SRT_STATE_TEXT:
                if (trim($line) == '') {
                    $sub = new stdClass;
                    $sub->number = $subNum;
                    list($sub->startTime, $sub->stopTime) = explode(' --> ', $subTime);
                    $sub->text   = $subText;
                    $subText     = '';
                    $state       = SRT_STATE_SUBNUMBER;
    
                    $subs[]      = $sub;
                } else {
                    $subText .= $line;
                }
                break;
        }
    }
    
    if ($state == SRT_STATE_TEXT) {
        // if file was missing the trailing newlines, we'll be in this
        // state here.  Append the last read text and add the last sub.
        $sub->text = $subText;
        $subs[] = $sub;
    }
    
    return $subs;

}

/*ECHO SINGLE SUBTITLE FILE*/
function echo_subtitles($path = NULL){

    if($path === NULL){
        return;
    }

    $subs = read_subtitles($path);

    foreach($subs as $sub){
        echo $sub->number . '<br>';
        echo $sub->startTime . ' --> ' . $sub->stopTime . '<br>';
        echo $sub->text;
        echo '<br><br>';
    }

}

/*ECHO INFO*/
function echo_info($target = 'I'){

    if($target === 'I'){
        // GET INPUT FILES
        $input_files = array_diff(scandir(INPUT_FOLDER), array('..', '.'));
        $input_file_count = count($input_files);

        if($input_file_count == 0){
            echo 'No files in ' . INPUT_FOLDER;
            return;
        }

        foreach($input_files as $input_file){
            echo $input_file . '<br>';
        }

    } else {
        // GET OUTPUT FILES
        $output_files = array_diff(scandir(OUTPUT_FOLDER), array('..', '.'));
        $output_file_count = count($output_files);

        if($output_file_count == 0){
            echo 'no files in ' . OUTPUT_FOLDER;
            return;
        }

        foreach($output_files as $output_file){
            echo $output_file . '<br>';
        }

    }
}