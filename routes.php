<?php

require_once __DIR__.'/router.php';

# A - Gestion des joueurs

#
get('/gamers/$joueur', 'gamers/joueur.php');



// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');
