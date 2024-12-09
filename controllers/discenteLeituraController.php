<?php
use Core\App;
use Core\Response;

if (isset($_GET['hash'])) {
    $hash = $_GET['hash'];

    $db = App::container()->resolve('Core\Database');

    // Consulta as informações do aluno
    $discente = $db->query(
        'SELECT * FROM ALUNOS WHERE matricula = :user;',
        ['user' => hex2bin($hash)]
    )->fetch();

    if (!$discente) {
        Response::FORBIDDEN;
    }

    // Converte explicitamente para um array associativo
    $discente = array_filter($discente, 'is_string', ARRAY_FILTER_USE_KEY);

    // Verifica se existe registro para hoje na tabela REGISTROS
    $hoje = date('Y-m-d');
    $registro = $db->query(
        'SELECT COUNT(*) as total FROM REGISTROS WHERE matricula_aluno = :matricula AND DATE(registro) = :hoje;',
        ['matricula' => hex2bin($hash), 'hoje' => $hoje]
    )->fetch();

    // Adiciona o campo 'retirado' ao resultado
    $discente['retirado'] = $registro['total'] > 0;

    // Retorna o JSON
    echo json_encode($discente, JSON_PRETTY_PRINT);

} else {
    echo "Parâmetros ausentes na URL.";
}
