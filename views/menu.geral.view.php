<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/menu.geral.css">
    <link rel="stylesheet" href="estilo/tutorial.css">
    <title>Menu Geral</title>
    <style>

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #4E935A;
            width: 80%;
            max-width: 400px;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .modal-buttons button {
            margin: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="img-principal">
        <a href="/retirarAlimento">
            <img src="imagens-menu/img-qrcode.png" alt="Imagem de QRcode">
        </a>
    </div><!--img-principal-->
    <div class="img">
        <img src="imagens-menu/img-1.png" alt="#">
        <img src="imagens-menu/img-2.png" alt="#">
        <br>
        <img src="imagens-menu/img-3.png" alt="#">
        <img src="imagens-menu/img-4.png" alt="#">
    </div><!--img-->
</div><!--container-->

<div class="container-footer">
    <button type="button" id="btn-tutorial">Tutorial</button>
    <button type="button">Sair</button>
</div>

<div class="modal-overlay" id="tutorial-modal">
    <div class="modal-content" id="modal-content">
        <img src="imagens-tutorial/frutas.png" alt="Frutas" />
        <p>
            Agradecemos por instalar o IFruta! Este sistema foi desenvolvido com o objetivo de melhorar
            a administração e distribuição de frutas e demais alimentos fornecidos gratuitamente aos
            alunos dos cursos técnicos do IFRS. Aqui teremos um tutorial para guiar você pelas
            funcionalidades oferecidas pelo sistema ;)
        </p>
        <div class="modal-buttons">
            <button id="skip-tutorial">Pular tutorial</button>
            <button id="next-tutorial">Próximo</button>
            <button id="mostrar-so-ultima-etapa">Ir para o menu Principal</button>
        </div><!--modal-buttons-->
    </div><!--modal-content-->
</div><!--modal-overlay-->

<script>
    // Selecionando elementos
    const tutorialBtn = document.getElementById('btn-tutorial');
    const modal = document.getElementById('tutorial-modal');
    const modalContent = document.getElementById('modal-content');

    // Inicializa o tutorial na etapa 0
    let currentStep = 0;

    // Passos do tutorial
    const steps = [
        {
            imgSrc: 'imagens-tutorial/frutas.png',
            text: 'Agradecemos por instalar o IFruta! Este sistema foi desenvolvido com o objetivo de melhorar a administração e distribuição de frutas e demais alimentos fornecidos gratuitamente aos alunos dos cursos técnicos do IFRS. Aqui teremos um tutorial para guiar você pelas funcionalidades oferecidas pelo sistema ;)'
        },
        {
            imgSrc: 'imagens-menu/img-qrcode.png',
            text: 'Clicando aqui você poderá ler o QR code para validar sua retirada das frutas. Nesse campo também serão exibidos os dados dos alunos, data e horário da última retirada.'
        },
        {
            imgSrc: 'imagens-menu/img-1.png',
            text: 'Clicando aqui você acessa um portal de noticias e avisos direcionados à comunidade beneficiada e aos administradores acerca da distribuição e fornecimento.'
        },
        {
            imgSrc: 'imagens-menu/img-2.png',
            text: 'Clicando aqui você acessa métricas pessoais e gerais de consumo. Uma ferramenta importante para acompanhar o quão eficientes poderemos ser para evitar o desperdício.'
        },
        {
            imgSrc: 'imagens-menu/img-3.png',
            text: 'Clicando aqui você acessa agenda semanal com o cardápio de frutas e dias de distribuição previstos, mas com possibilidade de alteração sem aviso prévio.'
        },
        {
            imgSrc: 'imagens-menu/img-4.png',
            text: 'Clicando aqui você acessa informações como local e horário de fornecimento por curso e também informações de cunho mais administrativo acerca da distribuição dos alimentos.'
        },
        {
            imgSrc: 'imagens-tutorial/frutas.png',
            text: 'Fim do tutorial! Aproveite as frutas! Se quiser recomeçar o tutorial é só clicar no botão "Tutorial", logo abaixo :).'
        }
    ];

    // Função para atualizar o conteúdo do modal
    function updateModalContent() {

        if (currentStep === steps.length - 1) {
            modalContent.innerHTML = `
            <img src="${steps[currentStep].imgSrc}" alt="Etapa do tutorial" />
            <p>${steps[currentStep].text}</p>
            <div class="modal-buttons">
                <button id="mostrar-so-ultima-etapa">Ir para o Menu Principal</button>
            </div>
        `;
        } else {
            modalContent.innerHTML = `
            <img src="${steps[currentStep].imgSrc}" alt="Etapa do tutorial" />
            <p>${steps[currentStep].text}</p>
            <div class="modal-buttons">
                <button id="skip-tutorial">Pular tutorial</button>
                <button id="next-tutorial">Próximo</button>
            </div>
        `;
        }

        // Reatribui os botões a cada nova atualização do modal
        const newSkipBtn = document.getElementById('skip-tutorial');
        const newNextBtn = document.getElementById('next-tutorial');
        const newMenuBtn = document.getElementById('mostrar-so-ultima-etapa');

        // Evento para "Pular tutorial"
        if (newSkipBtn) {
            newSkipBtn.addEventListener('click', () => {
                modal.classList.remove('active');
            });
        }

        // Evento para "Próximo"
        if (newNextBtn) {
            newNextBtn.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    updateModalContent();
                } else {
                    modal.classList.remove('active');
                }
            });
        }

        // Evento para "Ir para o Menu Principal" (na última etapa)
        if (newMenuBtn) {
            newMenuBtn.addEventListener('click', () => {
                modal.classList.remove('active');
            });
        }
    }

    // Abrir o modal ao clicar no botão "Tutorial"
    tutorialBtn.addEventListener('click', () => {
        modal.classList.add('active');
        currentStep = 0; // Reinicia o tutorial ao abrir
        updateModalContent();
    });

</script>

</body>
</html>


