﻿<?php

require_once('Routes/api.routes.php');

//Bendriniai puslapiai
require_once('Routes/page.routes.php');

//Autentikavimas
require_once('Routes/auth.routes.php');

//Vartotojai
require_once('Routes/user.routes.php');

//Balsavimas
require_once('Routes/vote.routes.php');

//Nustatymai
require_once('Routes/settings.routes.php');

//Temos
require_once('Routes/topic.routes.php');

//Skiltys
require_once('Routes/node.routes.php');

//Pranesimai
require_once('Routes/reply.routes.php');

//Busenos
require_once('Routes/status.routes.php');

//Paieška
require_once('Routes/search.routes.php');

//AZ
require_once('Routes/messenger.routes.php');

//TV
// require_once('Routes/tv.routes.php');

//Blog'ai
// require_once('Routes/blog.routes.php');

//Senų route 301 redirectai.
require_once('Routes/legacy.routes.php');