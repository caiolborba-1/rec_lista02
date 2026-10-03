<!-- usei um pouco de IA nesse codigo e nas outras tambem usei um pouco. -->
<?php

function contarMaiusculas($senha){
    return preg_match_all('/[A-Z]/', $senha);
}

function contarMinusculas($senha){
    return preg_match_all('/[a-z]/', $senha);
}

function contarNumeros($senha){
    return preg_match_all('/[0-9]/', $senha);
}

function contarEspeciais($senha){
    return preg_match_all('/[^\w\s]/u', $senha);
}

function contarCaracteres($senha){
    return strlen($senha);
}

$senha = "zIak12F*@00019***2AKBISaz";

$maiusculas = contarMaiusculas($senha);
$minusculas = contarMinusculas($senha);
$numeros = contarNumeros($senha);
$especiais = contarEspeciais($senha);
$tamanho = contarCaracteres($senha);

echo "Quantidade de maiúsculas: $maiusculas <br>";
echo "Quantidade de minúsculas: $minusculas <br>";
echo "Quantidade de números: $numeros <br>";
echo "Quantidade de caracteres especiais: $especiais <br>";
echo "Tamanho da senha: $tamanho <br>";

$criterios = 0;

if ($maiusculas > 0){
    $criterios++;
}

if ($minusculas > 0){
    $criterios++;
}

if ($numeros > 0){
    $criterios++;
}

if ($especiais > 0){
    $criterios++;
}

if ($tamanho > 8){
    $criterios++;
}

if ($criterios == 5){
    echo "Sua senha é muito forte!";
} elseif ($criterios == 4){
    echo "Sua senha é forte!";
} elseif ($criterios == 3){
    echo "Sua senha é média.";
} else {
    echo "Sua senha é fraca.";
}

?>