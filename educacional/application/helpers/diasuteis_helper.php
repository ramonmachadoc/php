<?php

function somar_dias_uteis($str_data, $int_qtd_dias_somar) {

    // Caso seja informado uma data do MySQL do tipo DATETIME - aaaa-mm-dd 00:00:00
    // Transforma para DATE - aaaa-mm-dd
    $str_data = substr($str_data, 0, 10);
    // Se a data estiver no formato brasileiro: dd/mm/aaaa
    // Converte-a para o padrão americano: aaaa-mm-dd
    if (preg_match("@/@", $str_data) == 1) {
        $str_data = implode("-", array_reverse(explode("/", $str_data)));
    }
    $array_data = explode('-', $str_data);
    $count_days = 0;
    $int_qtd_dias_uteis = 0;
    while ($int_qtd_dias_uteis < $int_qtd_dias_somar) {
        $count_days++;
        if (( $dias_da_semana = gmdate('w', strtotime('+' . $count_days . ' day', mktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '6') {
            $int_qtd_dias_uteis++;
        }
    }

    return gmdate('d/m/Y', strtotime('+' . $count_days . ' day', strtotime($str_data)));
}

function getWorkingDays($startDate, $endDate) {
  
    
    $begin = strtotime($startDate);
    $end = strtotime($endDate);

    if ($begin > $end) {


        //echo "startdate is in the future! <br />";

        return 0;
    } else {
        $no_days = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}
