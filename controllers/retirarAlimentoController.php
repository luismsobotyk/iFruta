<?php
use Core\App;

if($_SERVER["REQUEST_URI"]=='/retirarAlimento'){
    view('retirar.alimentos.view.php');
}else if($_SERVER["REQUEST_URI"]=='/retirarAlimento/retirar'){
    //dd($_SESSION['usuario']);
    view('retirar.view.php');
}