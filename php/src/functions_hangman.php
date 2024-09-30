<?php 
function generateEmptyAnswer($solution, $answer ){
    $answer = [];
    for($i = 0; $i < strlen($solution); $i++){
        $answer[] = '_';
    }

    return $answer;
}

function printAnswer($answer){
    echo "<p>";
    foreach($answer as $char){
        echo "<span>$char</span>";
    }
    echo "</p>";
}

function checkLetter($solution, $letter, &$answer){
    $isValid = false;
    $letter = strtolower($letter);
    if(strlen($letter) > 1 || !str_contains($solution, $letter)){
        return false;
    }
    for( $i = 0; $i < strlen($solution); $i++ ){
        if($solution[$i] == $letter ){
            $answer[$i] = $letter;
            $isValid = true;
        }
    }
    return $isValid;
}
