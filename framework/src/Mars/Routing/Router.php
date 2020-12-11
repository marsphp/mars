<?php


namespace Mars\Routing;

use Mars\Core\Core;

/**
 * Class Router
 *
 * @package Mars\Core
 */
class Router
{
    /**
     *
     *
     * @var array
     */
    protected array $routes = [];

    /**
     *
     *
     * @var Request
     */
    public Request $request;


    public Response $response;

    /**
     * Router constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     *
     *
     * @param string $path
     * @param $callback
     */
    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     *
     *
     * @return false|mixed|string
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return 'Not found';
        }
        
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback, $this->request);
    }

    /**
     * @param string $view
     * @return false|string|string[]
     */
    public function renderView(string $view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @param string $viewContent
     * @return false|string|string[]
     */
    public function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    protected function layoutContent()
    {
        ob_start();
        include_once Core::$ROOT_DIR. "/resources/views/layouts/main.php";
        return ob_get_clean();
    }

    /**
     * @param $view
     * @param $params
     * @return false|string
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Core::$ROOT_DIR. "/resources/views/$view.php";
        return ob_get_clean();
    }
}