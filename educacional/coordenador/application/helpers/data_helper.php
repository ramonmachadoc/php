<?php
function FormatarData($entrada) {

    $data =  date('d/m/Y', strtotime($entrada));

    return $data;
}
?>