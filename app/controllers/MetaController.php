<?php
__autoload("controller");
__autoload("helper");

class MetaController extends Controller {

    private $data;
    private $options;

    public function __construct()
    {
        $this->helper = new Helper();
    }

    public function headCodeFront()
    {
        // Get vars
        $settings = get_option("rentivoSettings");
        $this->set("settings", $settings);

        // Render view
        echo $this->view('injectables/front/head-code.html.twig');

    }

    public function headCodeAdmin()
    {
        // Get vars
        $siteUrl = get_site_url();
        $this->set("siteUrl", $siteUrl);

        // Render view
        echo $this->view('injectables/admin/head-code.html.twig');

    }

    public function footerCodeFront() {
        // Render view
        //echo $this->view('injectables/front/footer-code.html.twig');
    }


}