<!DOCTYPE html>
<html>
<head>
    <title>Instascan</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
<video id="preview"></video>
<div id="result"></div> <!-- Div para exibir os dados -->

<script>
    let scanner = new Instascan.Scanner(
        {
            video: document.getElementById('preview')
        }
    );

    scanner.addListener('scan', function (content) {
        //alert('Escaneou o conteúdo: ' + content);

        // Converte o conteúdo hexadecimal para ASCII

        // Faz a requisição para a URL com o hash
        fetch(`/discenteLeitura?hash=${content}`)
            .then(response => response.json())
            .then(data => {
                // Exibe os dados retornados na div "result"
                displayData(data);
            })
            .catch(error => {
                console.error('Erro ao obter dados:', error);
                document.getElementById('result').innerText = 'Erro ao obter dados.';
            });
    });

    Instascan.Camera.getCameras().then(cameras => {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error("Não existe câmera no dispositivo!");
        }
    });

    function hexToAscii(hex) {
        let ascii = '';
        for (let i = 0; i < hex.length; i += 2) {
            ascii += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
        }
        return ascii;
    }

    function displayData(data) {
        // Exibe os dados na div
        let resultDiv = document.getElementById('result');
        if (data && data.matricula) {
            resultDiv.innerHTML = `
            <h3>Dados do Discente</h3>
            <p><strong>Matricula:</strong> ${data.matricula}</p>
            <p><strong>Nome:</strong> ${data.nome}</p>
            <p><strong>Curso:</strong> ${data.id_curso}</p>
            <p><strong>Login:</strong> ${data.login}</p>
            <p><strong>Retirado:</strong> ${data.retirado ? 'Sim' : 'Não'}</p>
            <button ${data.retirado ? 'disabled' : ''} onclick="registerRetirada('${data.matricula}')">Entregar</button> <!-- Desabilita o botão se retirado for true -->
        `;
        } else {
            resultDiv.innerHTML = 'Dados não encontrados ou inválidos.';
        }
    }

    function registerRetirada(matricula) {
        // Faz a requisição AJAX para registrar a retirada
        fetch(`/registraRetirada?matricula=${matricula}`, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    // Exibe mensagem de erro se a retirada não for registrada
                    alert(`Erro: ${data.message}`);
                } else {
                    // Exibe mensagem de sucesso se o registro for realizado
                    alert('Retirada registrada com sucesso!');
                    // Opcionalmente, desabilita o botão "Entregar"
                    document.querySelector('button').disabled = true;
                }
            })
            .catch(error => {
                // Exibe uma mensagem de erro se ocorrer algum erro na requisição
                alert('Erro ao realizar a requisição: ' + error.message);
            });
    }
</script>

</body>
</html>
