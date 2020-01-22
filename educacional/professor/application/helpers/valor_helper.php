<?php

function FormatarValor($entrada) {

    $valor = number_format($entrada, 2, ',', ' ');

    return $valor;
}

?>