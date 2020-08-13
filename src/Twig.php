<?php

namespace App;

class Twig
{
    /**
     * Get all Twig system
     * @param string           $templates The templates directory
     * @param array            $settings  Optionnal settings for Twig
     * @return Twig_Environment All Twig system
     */
    public static function getTwig(
        $templates = __DIR__ . '/../templates',
        $settings = [
            'cache' => false
        ]
    ) {
        $loader = self::getTwigLoader($templates);
        return self::getTwigEnvironment($loader, $settings);
    }

    /**
     * Get an instance of *Twig_Loader_Filesystem*
     * @param  string                 $templates The directory where templates are stored
     * @return Twig_Loader_Filesystem The Twig loader
     */
    public static function getTwigLoader($templates)
    {
        return new \Twig\Loader\FilesystemLoader($templates);
    }

    /**
     * Get an instance of *Twig_Environment*
     * @param  Twig_Loader_Filesystem $loader   The Twig loader
     * @param  array                  $settings Optionnal settings for Twig
     * @return Twig_Environment       Twig
     */
    public static function getTwigEnvironment($loader, $settings)
    {
        return new \Twig\Environment($loader, $settings);
    }
}
