<?php

require_once './views/View.php';

class Router
{
    private $url;
    private $post;
    private $view;

    /**
     * Router constructor.
     * @param $url
     * @param $post
     */
    public function __construct($url, $post)
    {
        $this->url = $url;
        $this->post = $post;
        $this->view = new View();
    }

    public function route()
    {
        $urlParts = explode("/", $this->url);

        if (count($urlParts) == 4) {
            $id = $urlParts[3];
        }
        else{

        }


        if ($urlParts[1] == "") {
            $controllerName = "UsersController";
            $actionName = "signinAction";
        } else {
            $controllerName = $urlParts[1] . "Controller";
            $actionName = $urlParts[2] . "Action";
        }

        // $controllerPath = "./controllers/" . $controllerName . ".php";
        $controllerPath = current(preg_grep("/" . preg_quote($controllerName . ".php") . "/i", glob("./controllers/*")));

        if (file_exists($controllerPath) == false) {

            $this->view->render("sign", "shared/error404");
            die();
        }

        require_once $controllerPath;

        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action) == false) {
            $this->view->render("sign", "shared/error404");
            die();
        }

        try {

            if (count($this->post) == 0) {
                if (isset($id)) {
                    $controller->$action($id);
                } else {
                    $controller->$action();
                }
            } else {
                $controller->$action($this->post);
            }

        } catch (Exception $e) {
            $this->view->render("sign", "shared/error404");
        }


    }
}