<?php

namespace App;

class View
{
    public static function view(string $template, array $values = [], ?string $layout = null): void
    {
        extract($values, EXTR_SKIP);
        $template = str_replace('.', DIRECTORY_SEPARATOR, $template);
        $templatePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template . '.php';

        if ($layout === null) {
            require $templatePath;
            return;
        }

        ob_start();
        require $templatePath;
        $content = ob_get_clean();

        $layout = str_replace('.', DIRECTORY_SEPARATOR, $layout);
        $layoutPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $layout . '.php';
        require $layoutPath;
    }
}
