<?php


$router->get('/', 'controllers/index.php')->only('guest');

$router->post('/auth', 'controllers/auth.php');
$router->get('/auth', 'controllers/auth.php')->only('guest');

$router->get('/registro', 'controllers/registro.php')->only('auth');

$router->post('/registrar', 'controllers/registrar.php')->only('auth');


$router->get('/exit', 'controllers/exit.php');
$router->post('/sair', 'controllers/exit.php');

// Novas Rotas
$router->get('/menu', 'controllers/menuController.php')->only('auth');;
$router->get('/retirarAlimento', 'controllers/retirarAlimentoController.php')->only('auth');
$router->get('/retirarAlimento/retirar', 'controllers/retirarAlimentoController.php')->only('auth');
$router->get('/qrcode', 'controllers/QRCodeController.php')->only('auth');

//Rotas para verificação da leitura
$router->get('/testeRead', 'controllers/Reader.php');
$router->get('/discenteLeitura', 'controllers/discenteLeituraController.php');
$router->get('/registraRetirada', 'controllers/registraRetiradaController.php');
