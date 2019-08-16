<?php

class AnketaAdd extends FormAjax
{

    public function create_fields()
    {
        $this->add_check_fields("name", "notempty");
        $this->add_check_fields("age", "notempty");
        $this->add_check_fields("city", "notempty");
        $this->add_check_fields("phone", "notempty");
        $this->add_check_fields("info", "notempty");
    }

    public function exec()
    {

        if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], 'new_user')) {
            // throw new Exception( 'Оооопс, все вышло из под контроля, попробуйте еще разок, но чуть позже?' );
        }
        $name = $_POST["name"];
        $age = $_POST["age"];
        $city = $_POST["city"];
        $phone = $_POST["phone"];
        $info = $_POST["info"];

        $text = "Имя: " . $name . "
    Возраст: $age
    Город: $city
    Телефон: $phone
    Информация: $info";

        global $themeAR;
        $mail = $themeAR->get_option("emailanket");

        var_dump($_FILES);
        for ($i = 1; $i < 10; $i++) {
            if (isset($_FILES['file_' . $i])) {

            }
        }
        var_dump($mail);
        wp_mail($mail, "Новая анкета", $text);

        $result["msg"] = "Ваша анкета отправлена, в ближайшее время с вами свяжется менеджер";

        //$result["redirect"] =  get_permalink(329);
        return $result;
    }

}