<?php
if (!function_exists('data_banco')) {

    function data_banco($data) {

        $data = DateTime::createFromFormat('!d-m-Y', str_replace('/', '-', $data));
        return $data->format('Y-m-d H:i:s');
    }
}

if (!function_exists('data_exibicao')) {

    function data_exibicao($data) {

        return date('d/m/Y', strtotime($data));
    }
}

