<?php
__autoload("helper");

class Validator {

    protected $rules = array();
    protected $errors = array();
    protected $vRules = array();
    protected $helper;

    function __construct() {

        $this->helper = new Helper();

        $this->vRules = array(
            "numeric" => array(
                "function" => "isNumeric",
                "error" => "***** must be numeric"
            ),
            "required"  => array(
                "function" => "exists",
                "error" => "***** is required"
            )
        );
    }

    public function rule($rule) {
        array_push($this->rules, $rule);
    }

    public function rules($rules) {
        if (is_array($rules)) {
            return $this->rules = $rules;
        } else {
            return $this->error("Rules var must be array");
        }
    }

    public function validate($http) {

        $this->errors = array();
        if(!empty($http)) {
            foreach ($http as $inputKey => $inputValue) {

                if (empty($inputValue) or !array_key_exists($inputKey, $this->rules)) {
                    break;
                }

                $rules = explode("|", $this->rules[$inputKey]);

                foreach ($rules as $rule) {

                    if (!array_key_exists($rule, $this->vRules)) {
                        echo $this->error("Rule does not exist");
                        return false;
                    }

                    $result = call_user_func(array($this, $this->vRules[$rule]["function"]), $inputValue);

                    if (!$result) {
                        array_push($this->errors, str_replace("*****", $inputKey, $this->vRules[$rule]["error"]));
                    }

                }

            }
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }

    }

    public function getErrors() {
        return $this->errors;
    }

    private function error($error) {
        return $this->helper->showError($error);
    }

    private function exists($input) {
        if ($input) {
            return true;
        }  else {
            return false;
        }
    }

    private function isNumeric($input) {
        if (is_numeric($input)) {
            return true;
        }  else {
            return false;
        }
    }

}