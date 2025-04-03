<?php

require_once __DIR__.'/router.php';

# A - Gestion des joueurs

## <path>#/gamers/<joueur>
get('/gamers/$joueur', 'gamers/joueur.php');

## <path>#/gamers/add/<joueur>/<pwd>
post('/gamers/add/$joueur/$pwd', 'gamers/add.php');

## <path>#/gamers/login/<joueur>/<pwd>
put('/gamers/login/$joueur/$pwd', 'gamers/login.php');

## <path>#/gamers/logout/<joueur>/<pwd>
put('gamers/logout/$joueur/$pwd', 'gamers/logout.php');

# B - Consultation admin

## <path>#/admin/top[/<nb>]

## <path>#/admin/delete/joueur/<joueur>

## <path>#/admin/delete/def/<id>

# C - Consultation des définitions

## <path>#/word[/<nb>[/<from>]]

# D- Page Web (2 jeux et 2 interfaces de consultation)

## <path>#/jeu/word/[<lg>[/<time>[/<hint>]]]

## <path>#/jeu/def[/<lg>/[/<time>]]

## <path>#/dump/<step>

## <path>#/doc

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');
