<?php

function um () {
    throw new Exception("Loucura 1", 104);
}


function dois(){
    try{
        um();
    } catch(Exception $e){
        throw new Exception("Loucura 2", 120);
    }

}



function tres(){
    try{
        dois();
    }catch (Exception $e) {
        echo $e->getMessage();
    }
}



tres();










