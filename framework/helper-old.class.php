<?php
class Helper {

    //private static $instance;

    function __construct() {
        $this->config = require ROOT . "/config.php";
    }

    /*
    private function __clone() {}


    public static function getInstance() {
        if (!Helper::$instance instanceof self) {
            Helper::$instance = new self();
        }
        return Helper::$instance;
    }
*/

    function getConfig($configName) {
        return $this->config[$configName];
    }

    function setConfig($configName, $value) {
        $this->config[$configName] = $value;
        return $this->config[$configName];
    }


    function assetUrl($uri) {
        return $this->getConfig("assetUrl") . "/" . $uri;
    }

    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function convertAttributeKeys($attributes, $settings) {
        $newArray = array();
        foreach ($attributes as $key => $value) {
            if (array_key_exists($key, $settings)) {
                $newArray[$settings[$key][0]] = $value;
            }
        }
        return $newArray;
    }

    function convertAttributeRules($settings) {
        $rules = array();
        foreach ($settings as $settingKey => $settingArr) {
            if (array_key_exists(2, $settingArr)) {
                $rules[$settingKey] = $settingArr[2];
            }
        }
        return $rules;
    }

    function convertDefaultAttributes($settings) {
        $defaults = array();
        foreach ($settings as $defaultKey => $defaultArr) {
            if (array_key_exists(1, $defaultArr)) {
                if ($defaultArr[1]) {
                    $defaults[$defaultArr[0]] = $defaultArr[1];
                } else if(is_bool($defaultArr[1]) and $defaultArr[1] == false) {
                    $defaults[$defaultArr[0]] = $defaultArr[1];
                }
            }
        }
        return $defaults;
    }

    function convertBoolsToBinaryString($attributes) {
        $newArray = array();
        foreach ($attributes as $key => $value) {
            // If boolean
            if (is_bool($value)) {
                if ($value) {
                    $newArray[$key] = "1";
                } else {
                    $newArray[$key] = "0";
                }
                //$newArray[$key] = ($value == true) ? "1" : "0";
            } else {
                $newArray[$key] = $value;
            }
        }
        return $newArray;
    }

    function showError($msg) {
        return "<div class='rw-alert-box rw-alert-box-error'>$msg</div>";
    }

}