<?php
//IMPORT DES RESSOURCES
include './utils/utils.php';
include './View/viewHeader.php';
include './View/viewHome.php';
include './Model/ModelCategory.php';
include './Controller/controllerHome.php';


//CREER UN OBJET CONTROLLER, PUIS FAIRE LE RENDU DE LA PAGE
$home = new controllerHome(new ViewHome(),new ModelCategory());
echo $home->signUp();
$home->render();

include './View/viewFooter.php';