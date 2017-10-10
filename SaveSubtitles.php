<?php

/*INCLUDE ROOT FUNCTIONS FILE*/
include 'OrderFixer.php';

// Remove root and current folder from array
$input_files = array_diff(scandir(INPUT_FOLDER), array('..', '.'));
// Count the number of files
$file_count = count($input_files);

// Modify each subtitle file
for($c=2; $c<=$file_count+1; $c++){

    $subs = read_subtitles( INPUT_FOLDER . $input_files[$c] );

    $output_file = OUTPUT_FOLDER . $input_files[$c];

    fopen($output_file, 'w') or die('Cannot open file:  '.$output_file); //implicitly creates file

    // change every second subtitle in array

    $subs_count = count($subs);
    $counter = 1;
    $previous_item = NULL;
    $current_item = NULL;

    for($i = 0; $i<$subs_count; $i++){
        if($counter == 1){
        }
        elseif( $counter % 2 == 0 ){
            $current_item = $subs[$i];

            //exchange positions
            $subs[$i-1] = $current_item;
            $subs[$i-1]->number = $counter-1;
            $subs[$i] = $previous_item;
            $subs[$i]->number = $counter;
        }
        else{
        }
        $previous_item = $subs[$i];
        $counter++;
    }

    // Save subtitles

    foreach($subs as $sub){
        file_put_contents( $output_file, $sub->number . PHP_EOL, FILE_APPEND | LOCK_EX );
        file_put_contents( $output_file, $sub->startTime . ' --> ' . $sub->stopTime . PHP_EOL, FILE_APPEND | LOCK_EX );
        file_put_contents( $output_file, $sub->text . PHP_EOL, FILE_APPEND | LOCK_EX );
        file_put_contents( $output_file, '' . PHP_EOL, FILE_APPEND | LOCK_EX );
    }

}

//Return to index
header('Location:index.php');