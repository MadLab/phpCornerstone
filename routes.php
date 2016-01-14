<?php

/**
 * phpCornerstone Routes
 *
 */

use MadLab\Cornerstone\Components\Config;
use MadLab\Cornerstone\App;
use MadLab\Cornerstone\Components\Routers\FileRouter;
use MadLab\Cornerstone\Components\Routers\MapRouter;


App::addRouter(new FileRouter(Config::get('NAKED_DOMAIN'), ''));