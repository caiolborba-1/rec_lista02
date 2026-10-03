<?php

function contarCaracteres($texto){

    return strlen($texto);
}

function contarPalavras($texto){

    return str_word_count($texto);
}

function contarFrases($texto){

    return preg_match_all('/[.?!]/', $texto);
}

function encontrarMaiorPalavra($texto){

    $lista = str_word_count($texto, 1);
    $maior = "";

    foreach ($lista as $palavra){

        if (strlen($palavra) > strlen($maior)){
            $maior = $palavra;
        }
    }

    return $maior;
}

function contarRepetidas($texto){

    $lista = str_word_count(strtolower($texto), 1);
    $contagem = array_count_values($lista);
    $repetidas = 0;

    foreach ($contagem as $quantidade){

        if ($quantidade > 1){
            $repetidas += $quantidade;
        }
    }

    return $repetidas;
}

$texto = "Uma editora deseja gerar automaticamente estatísticas sobre textos enviados pelos autores. Texto de exemplo. Texto que não é de exemplo.";

echo "Quantidade de caracteres: " . contarCaracteres($texto) . "<br>";
echo "Quantidade de palavras: " . contarPalavras($texto) . "<br>";
echo "Quantidade de frases: " . contarFrases($texto) . "<br>";
echo "Maior palavra: " . encontrarMaiorPalavra($texto) . "<br>";
echo "Quantidade de palavras repetidas: " . contarRepetidas($texto) . "<br>";

?>