<?php

function ordenarConsultas($consultas){

    usort($consultas, function($a, $b){
        return strcmp($a["horario"], $b["horario"]);
    });

    return $consultas;
}

function contarPacientes($consultas){

    $nomes = array_column($consultas, "paciente");

    return count(array_unique($nomes));
}

function contarEspecialidades($consultas){

    $resultado = [];

    foreach ($consultas as $consulta){

        $especialidade = $consulta["especialidade"];

        if (isset($resultado[$especialidade])){
            $resultado[$especialidade]++;
        } else {
            $resultado[$especialidade] = 1;
        }
    }

    return $resultado;
}

function procurarPaciente($consultas, $nome){

    $resultado = [];

    foreach ($consultas as $consulta){

        if (strtolower($consulta["paciente"]) == strtolower($nome)){
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

function verificarHorarios($consultas){

    $horarios = array_column($consultas, "horario");

    if (count($horarios) != count(array_unique($horarios))){
        return true;
    }

    return false;
}

function organizarAgenda($consultas, $nomePaciente){

    $agenda = ordenarConsultas($consultas);

    return [
        "total" => count($consultas),
        "pacientes" => contarPacientes($consultas),
        "especialidades" => contarEspecialidades($consultas),
        "primeiro" => $agenda[0],
        "ultimo" => $agenda[count($agenda) - 1],
        "agenda" => $agenda,
        "paciente" => procurarPaciente($consultas, $nomePaciente),
        "horario_duplicado" => verificarHorarios($consultas)
    ];
}

$agenda = [
    ["paciente" => "Carlos", "especialidade" => "Cardiologia", "data" => "10/05/2026", "horario" => "14:00"],
    ["paciente" => "Ana", "especialidade" => "Dermatologia", "data" => "10/05/2026", "horario" => "09:00"],
    ["paciente" => "Bruno", "especialidade" => "Cardiologia", "data" => "10/05/2026", "horario" => "10:30"],
    ["paciente" => "Ana", "especialidade" => "Pediatria", "data" => "10/05/2026", "horario" => "16:00"]
];

$resultado = organizarAgenda($agenda, "Ana");

echo "Total de consultas: " . $resultado["total"] . "<br>";
echo "Pacientes diferentes: " . $resultado["pacientes"] . "<br>";

echo "Consultas por especialidade:<br>";

foreach ($resultado["especialidades"] as $especialidade => $quantidade){
    echo "$especialidade: $quantidade<br>";
}

echo "Primeiro atendimento: " . $resultado["primeiro"]["paciente"] . " - " . $resultado["primeiro"]["horario"] . "<br>";
echo "Último atendimento: " . $resultado["ultimo"]["paciente"] . " - " . $resultado["ultimo"]["horario"] . "<br>";

echo "Paciente pesquisado: <br>";

foreach ($resultado["paciente"] as $consulta){
    echo $consulta["paciente"] . " - " . $consulta["especialidade"] . " - " . $consulta["horario"] . "<br>";
}

if ($resultado["horario_duplicado"]){
    echo "Existem horários duplicados.";
} else {
    echo "Não existem horários duplicados.";
}

?>