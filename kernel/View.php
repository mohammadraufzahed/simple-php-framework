<?php

namespace SimplePHPFramework\kernel;

use Pug\Pug;

class View
{
    /**
     * Render the page view
     * @param string $template
     */
    static public function render(string $template, $params = [])
    {
        $rootDirectory = $_SERVER["DOCUMENT_ROOT"];
        $viewDir = dir($rootDirectory . "/../views");
        $templatePath = $viewDir->path . "/" . $template;
        if (!file_exists($templatePath)) {
            echo "Template not found";
            exit;
        }
        $pugEngine = new Pug([
            "pretty" => true,
            "cache" => $_SERVER["DOCUMENT_ROOT"] . "/../views/cache"
        ]);
        $pugEngine->display($templatePath, $params);
    }
}
