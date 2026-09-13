<?php

//evita a entrada de characters invalidos(exemplo texto no inteiro)
function sanitizar(mixed $entrada, string $tipo): mixed
{
    switch ($tipo) {
        case 'inteiro':
            return (int) filter_var($entrada, FILTER_SANITIZE_NUMBER_INT);
        
        case 'texto':
        default:
            return filter_var($entrada, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}