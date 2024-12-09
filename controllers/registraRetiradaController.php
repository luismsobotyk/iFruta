<?php
use Core\App;
use Core\Response;

// Verifica se a matrícula foi passada via URL
if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    // Conecta ao banco de dados
    $db = App::container()->resolve('Core\Database');

    try {
        // Verifica se a matrícula existe na tabela ALUNOS
        $alunoExists = $db->query('SELECT COUNT(*) as count FROM ALUNOS WHERE matricula = :matricula;', ['matricula' => $matricula])->fetch();

        if ($alunoExists['count'] === 0) {
            // Se não existe um aluno com a matrícula fornecida, retorna erro
            $response = [
                'erro' => true,
                'message' => 'Matrícula não encontrada.'
            ];
        } else {
            // Verifica se já existe um registro para a matrícula no dia atual
            $existingRecord = $db->query('SELECT COUNT(*) as count FROM REGISTROS WHERE matricula_aluno = :user AND CAST(registro AS DATE) = CAST(current_timestamp() AS DATE);', ['user' => $matricula])->fetch();

            if ($existingRecord['count'] > 0) {
                // Se já existe um registro para o dia, retorna um erro
                $response = [
                    'erro' => true,
                    'message' => 'Já existe um registro para esta matrícula hoje.'
                ];
            } else {
                // Se não existe, realiza a inserção do registro
                $db->query('INSERT INTO REGISTROS (matricula_aluno) VALUES(:usuario_matricula);', ['usuario_matricula' => $matricula]);

                // Obtém o registro inserido
                $data_reg = $db->query('SELECT registro FROM REGISTROS WHERE matricula_aluno = :user AND CAST(registro AS DATE) = CAST(current_timestamp() AS DATE);', ['user' => $matricula])->fetchOrFail(Response::FORBIDDEN);

                // Prepara a resposta JSON
                $response = [
                    'erro' => false,
                    'message' => 'Registro inserido com sucesso.',
                    'registro' => $data_reg['registro']
                ];
            }
        }

    } catch (Exception $e) {
        // Em caso de erro, captura a exceção e retorna a mensagem de erro
        $response = [
            'erro' => true,
            'message' => 'Erro ao inserir registro: ' . $e->getMessage()
        ];
    }

} else {
    // Caso não tenha sido passada a matrícula pela URL
    $response = [
        'erro' => true,
        'message' => 'Matrícula não informada.'
    ];
}

// Retorna o resultado em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
