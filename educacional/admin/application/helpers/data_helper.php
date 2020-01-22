<?php
function FormatarData($entrada) {

    $data =  date('d/m/Y', strtotime($entrada));

    return $data;
}

function FormataDataBanco($entrada) {


    $databanco = explode('/', $entrada);
    $databanco = $databanco[2] . "-" . $databanco[1] . "-" . $databanco[0];
    return $databanco;
}

?>