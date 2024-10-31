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
        if(!empty($attributes)) {
            foreach ($attributes as $key => $value) {
                if (array_key_exists($key, $settings)) {
                    $newArray[$settings[$key][0]] = $value;
                }
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

            // If is array
            if(is_array($value)) {
                $newArray[$key] = $this->convertBoolsToBinaryString($value);
            } else {
                if (is_bool($value) or $value == "true" or $value == "false") {
                    if (filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
                        $newArray[$key] = "1";
                    } else {
                        $newArray[$key] = "0";
                    }
                    //$newArray[$key] = ($value == true) ? "1" : "0";
                } else {
                    $newArray[$key] = $value;
                }
            }

        }
        return $newArray;
    }

    function parseDotArray(&$array, $folder, $value)
    {
        // split the folder name by . into an array
        $path = explode('.', $folder);

        // set the pointer to the root of the array
        $root = &$array;

        // loop through the path parts until all parts have been removed (via array_shift below)
        while (count($path) > 1) {
            // extract and remove the first part of the path
            $branch = array_shift($path);
            // if the current path hasn't been created yet..
            if (!isset($root[$branch])) {
                // create it
                $root[$branch] = array();
            }
            // set the root to the current part of the path so we can append the next part directly
            $root = &$root[$branch];
        }

        // set the value of the path to an empty array as per OP request
        $root[$path[0]] = $value;
    }

    function convertDotIntoArray($params) {
        $output = array();

        foreach ($params as $key => $value) {
            if (strpos($key, '.') !== false) {
                $this->parseDotArray($output, $key, $value);
            } else {
                $output[$key] = $value;
            }
        }

        //$this->debug($output);
        return $output;

    }

    function showError($msg) {
        return "<div class='rw-alert-box rw-alert-box-error'>$msg</div>";
    }

    function debug($output) {
        echo "<br><br><pre>";
        print_r($output);
        echo "</pre><br><br>";
    }

}