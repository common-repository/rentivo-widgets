<?php
__autoload("MetaController");
add_action('wp_head', array(new MetaController(), "headCodeFront"));
add_action('wp_footer', array(new MetaController(), "footerCodeFront"));
add_action('admin_head', array(new MetaController(), "headCodeAdmin"));