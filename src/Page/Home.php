<?php

namespace Page;

use \App\Twig;

class Home
{
    public function GET()
    {
        $twig = Twig::getTwig();
        $template = $twig->load('home.html.twig');
        echo $template->render([]);
    }
}
