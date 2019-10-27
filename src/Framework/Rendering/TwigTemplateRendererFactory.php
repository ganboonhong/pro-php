<?php declare (strict_types = 1);

namespace SocialNews\Framework\Rendering;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class TwigTemplateRendererFactory
{
    public function create(): TwigTemplateRenderer
    {
        $loader = new FilesystemLoader([]);
        $twigEnvironment = new Environment($loader);
        return new TwigTemplateRenderer($twigEnvironment);
    }
}
