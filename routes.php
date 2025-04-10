<?php

require_once __DIR__.'/router.php';

# Seed database
get('/seed', 'api/database/sql/seed.php');

# Home page
get('/', 'index.php');

# A - Gestion des joueurs

## <path>#/gamers/<joueur>
get('/gamers/$joueur', 'api/gamers/joueur.php');

## <path>#/gamers/add/<joueur>/<pwd>
post('/gamers/add/$joueur/$pwd', 'api/gamers/add.php');


## <path>#/gamers/login/<joueur>/<pwd>
put('/gamers/login/$joueur/$pwd', 'api/gamers/login.php');

## <path>#/gamers/logout/<joueur>/<pwd>
put('/gamers/logout/$joueur/$pwd', 'api/gamers/logout.php');

# B - Consultation admin

## <path>#/admin/top[/<nb>]
get('/admin/top/$nb', 'api/admin/top.php');

## <path>#/admin/delete/joueur/<joueur>
delete('/admin/delete/joueur/$joueur', 'api/admin/delete/joueur.php');

## <path>#/admin/delete/def/<id>
delete('/admin/delete/def/$id', 'api/admin/delete/def.php');

# C - Consultation des définitions

## <path>#/word[/<nb>[/<from>]]
get('/word/$nb/$from', 'api/word/word.php');
get('/word/$nb', 'api/word/word.php');
get('/word', 'api/word/word.php');

# D- Page Web (2 jeux et 2 interfaces de consultation)

## <path>#/jeu/word/[<lg>[/<time>[/<hint>]]]
get('/jeu/word/$lg/$time/$hint', '/jeu/word.php');
get('/jeu/word/$lg/$time', '/jeu/word.php');
get('/jeu/word/$lg', '/jeu/word.php');

## <path>#/jeu/def[/<lg>/[/<time>]]
get('/jeu/def/$lg/$time', '/jeu/def.php');
get('/jeu/def/$lg', '/jeu/def.php');

## <path>#/dump/<step>
get('/dump/$step', '/dump/dump.php');

## <path>#/doc
get('/doc', '/doc/doc.php');

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','404/404.php');
