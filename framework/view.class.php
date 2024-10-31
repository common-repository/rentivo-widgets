<?php
class View {

    protected $variables = array();
    protected $_controller;
    protected $_action;
    protected $loader;
    protected $twig;

    function __construct() {
        //$this->_controller = $controller;
        //$this->_action = $action;

        $this->loader = new Twig_Loader_Filesystem(ROOT . DS .'app/views/');
        $this->twig = new Twig_Environment($this->loader);
    }

    /** Set Variables **/
    function set($name, $value) {
        $this->variables[$name] = $value;
    }

    /** Display Template **/
    function render($page) {
        return $this->twig->render($page, $this->variables);
    }

}