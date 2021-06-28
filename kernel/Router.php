<?php


namespace SimplePHPFramework\kernel;

require __DIR__ . "/../vendor/autoload.php";

class Router
{
    private array $getRequests = [];
    private array $postRequests = [];


    public function __construct()
    {
    }

    /**
     * Render the page view
     * @param string $template
     */
    static public function renderView(string $template)
    {
        $viewDir = dir($_SERVER["DOCUMENT_ROOT"] . "/../views");
        $templatePath = $viewDir->path . "/" . $template;
        if (!file_exists($templatePath)) {
            echo "Template not found";
        } else {
            include_once $templatePath;
        }
    }

    /**
     * Handle The get request
     * @param string $uri
     * @param array $fn
     */
    public function get(string $uri, array $fn): void
    {
        $this->getRequests[$uri] = $fn;
    }

    /**
     * Handle the post request
     * @param string $uri
     * @param string $fn
     */
    public function post(string $uri, string $fn): void
    {
        $this->postRequests[$uri] = $fn;
    }

    /**
     * Start the Router
     */
    public function start(): void
    {
        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        $uri = $_SERVER["PATH_INFO"] ?? "/";
        if ($method == "post") {
            if (!isset($this->postRequests[$uri])) {
                echo "Page not found";
                exit;
            }
            $fn = $this->postRequests[$uri];
            if ($this->checkUriFunc($fn)) {
                echo "Page not found";
                exit;
            }
            echo call_user_func($fn);
        } elseif ($method == "get") {
            if (!$this->getRequests[$uri]) {
                echo "Page not found";
                exit;
            }
            $fn = $this->getRequests[$uri];
            if ($this->checkUriFunc($fn)) {
                echo "Page not found";
                exit;
            }
            echo call_user_func($fn);
        } else {
            echo "Request not allowed";
            exit;
        }
    }

    /**
     * Check the uri function exists
     * @param $func
     * @return bool
     */
    private function checkUriFunc($func): bool
    {

        return empty($func);
    }
}
