<?php


namespace SimplePHPFramework\kernel;

require __DIR__ . "/../vendor/autoload.php";

class Router
{
    private array $getRequests = [];
    private array $postRequests = [];
    private string $requestMethod = "";
    private string $requestUri = "";


    public function __construct()
    {
    }

    /**
     * Handle The get request
     * @param string $uri
     * @param array $fn
     * @return void
     */
    public function get(string $uri, array $function): void
    {
        if (isset($this->getRequests[$uri])) {
            echo "Your not allowed to add the duplicate route in the one method<br/>Duplicate URI: $uri <br /> Method: GET";
            exit;
        }
        $this->getRequests[$uri] = $function;
    }

    /**
     * Handle the Get routing
     * @return void
     */
    private function handleGet(): bool
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestUri = $_SERVER["PATH_INFO"];
        // Checking the request method
        if ($requestMethod == "GET") {
            // Grab the URI path of the page
            $uri = $requestUri ?? '/';
            // Checking the URI exists or not
            if (isset($this->getRequests[$uri])) {
                // Grab the controller
                $routerFunction = $this->getRequests[$uri];
                // Verify the controller
                if (!$this->checkUriFunc($routerFunction)) {
                    // If the controller does not exists echo the error
                    echo "The controller of this route does not found";
                } else {
                    // Run the controller
                    call_user_func($routerFunction);
                    return true;
                }
            } else {
                // if page not found echo the error
                echo "Page not found";
                exit;
            }
        } else {
            return false;
        }
    }

    /**
     * Handle the post request
     * @param string $uri
     * @param array $fn
     * @return void
     */
    public function post(string $uri, array $function): void
    {
        if (isset($this->postRequests[$uri])) {
            echo "Your not allowed to add the duplicate route in the one method<br/>Duplicate URI: $uri <br /> Method: POST";
            exit;
        }
        $this->postRequests[$uri] = $function;
    }

    /**
     * Handle the post routing
     */
    private function handlePost()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestUri = $_SERVER["PATH_INFO"];
        // Checking the request method
        if ($requestMethod == "POST") {
            // Grab the URI path of the page
            $uri = $requestUri ?? '/';
            // Checking the URI exists or not
            if (isset($this->postRequests[$uri])) {
                // Grab the controller
                $routerFunction = $this->postRequests[$uri];
                // Verify the controller
                if (!$this->checkUriFunc($routerFunction)) {
                    // If the controller does not exists echo the error
                    echo "The controller of this route does not found";
                } else {
                    // Run the controller
                    call_user_func($routerFunction);
                    return true;
                }
            } else {
                // if page not found echo the error
                echo "Page not found";
                exit;
            }
        } else {
            return false;
        }
    }

    /**
     * Start the Router
     * @return void
     */
    public function start(): void
    {
        if ($this->handleGet()) {
        } elseif ($this->handlePost()) {
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
    private function checkUriFunc($function): bool
    {
        $isFunctionValid = is_object($function[0]);
        return $isFunctionValid;
    }
}
