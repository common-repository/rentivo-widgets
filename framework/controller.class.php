<?php
class Controller {

    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_view;
    protected $twig;
    protected $loader;
    protected $variables = array();
    //protected $_template;

    function __construct($model, $controller, $action) {

        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;
        $this->_view = new View();

    }

    /** Set Variables **/
    function set($name, $value) {
        $this->variables[$name] = $value;
    }

    /** Set Variables **/
    function get($name) {
        return $this->variables[$name];
    }

    /** Display Template **/
    function view($page) {

        $loader = new Twig_Loader_Filesystem(ROOT . DS .'app/views/');
        $twig = new Twig_Environment($loader, array(
            'debug' => true,
            'charset' => 'utf-8',
            'auto_reload' => true,
            'strict_variables' => false,
            'autoescape' => true,
            'optimizations' => -1
        ));

        return $twig->render($page, $this->variables);
    }

    /*
    function __destruct() {
        $this->_template->render();
    }
    */

}