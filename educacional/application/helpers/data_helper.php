<?php

function FormatarData($entrada) {

    $data = date('d/m/Y', strtotime($entrada));
    return $data;
}

function geraTimestamp($dataInicial, $dataFinal) {

    $time_inicial = strtotime($dataInicial);
    $time_final = strtotime($dataFinal);
    $diferenca = $time_final - $time_inicial;
    $dias = (int) floor($diferenca / (60 * 60 * 24));
    return $dias;
}

?>