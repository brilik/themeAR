<?php


class FormAjax
{
    protected $error_fields;
    protected $check_fields;
    protected $result;

    //type - 1 только зарегистрированный 2 - только не зарегистрированных 3 - для всех
    public function __construct($internal, $type = 3)
    {
        if ($type == 1 || $type == 3) {
            add_action('wp_ajax_' . $internal, array($this, 'run'));
        }
        if ($type == 2 || $type == 3) {
            add_action('wp_ajax_nopriv_' . $internal, array($this, 'run'));
        }
        $this->error_fields = [];
        $this->create_fields();
    }

    public function add_check_fields($name, $validator)
    {
        $this->check_fields[$name] = $validator;
    }

    public function run()
    {
        $result = [];
        try {

            if ($this->check_error()) {
                foreach ($this->error_fields as $name => $msg) {
                    $result["fielderror"][] = (object)["field" => $name, "msg" => $msg];
                }
                $result["result"] = "error";
            } else {
                $result = $this->exec();
            }
        } catch (Exception $e) {
            $result["result"] = "error";
            $result["msg"] = $e->getMessage();
        }

        echo json_encode($result);
        die(0);
    }

    public function add_error_field($field, $msg)
    {
        $this->error_fields[$field] = $msg;
    }

    public function check_error()
    {
        foreach ($this->check_fields as $name => $validator) {
            $value = $_POST[$name];
            if (strpos($validator, "notempty") !== false && $value == "") {
                $this->add_error_field($name, "Не может быть пустым");
            }
            if (strpos($validator, "email") !== false && !ValidatorHR::is_email($value)) {
                $this->add_error_field($name, "email имеет неверный формат ");
            }
        }

        if (count($this->error_fields) > 0) {
            return true;
        }

        return false;

    }
}