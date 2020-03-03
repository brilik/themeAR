<?php

class Instagram
{
    /*
     * создаем новое подключение к API Instagram;
     */
    private $access_token = '5515150877.54da896.4aff2bc85eb54726a3649a798df1f62c';
    private $username = 'vito.bryliano';
    /*
    * Тут указываем либо ID пользователя, либо "self" для вывода фото владельца токена
    * Как получить ID? Да в том же инструменте, в котором вы получали токен
    */
    private $tag = 'self';
    // количество фотографий для вывода
    private $limit = 9;

    public function the_instagram_api()
    {
        $media = $this->__instagram_api_curl_connect('https://api.instagram.com/v1/users/' . $this->tag . '/media/recent?access_token=' . $this->access_token);
        $res = '';
        if (!empty($media)) {
            $res = '<a href="https://www.instagram.com/' . $this->username . '/" class="footer-title">' . __('ИНСТАГРАМ') . '</a>';
            $res .= '<ul class="photo-list">';
            /*
             * функция array_slice() задает количество элементов, которые нам нужно получить из массива
             * если нам нужно вывести все фото, тогда: foreach($media->data as $data) {
             */
//            foreach(array_slice($media->data, 0, $this->limit) as $data) {
            foreach ($media->data as $key => $data) {
                if ($key >= $this->limit) break 1;
                $res .= '<li class="photo-list__item">';
                $res .= '<a href="' . $data->link . '" class="photo-list__link" target="_blank">';
                $res .= '<img data-src="' . $data->images->low_resolution->url . '" src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" class="js-img" alt="">';
                $res .= '</a>';
                $res .= '</li>';
            }

            $res .= '</ul>';
            $res .= '<a href="https://www.instagram.com/' . $this->username . '/" class="open-profile">' . __('Открыть профиль') . '</a>';
        }

        return $res;
    }

    private function __instagram_api_curl_connect($api_url)
    {
        $connection_c = curl_init(); // initializing
        curl_setopt($connection_c, CURLOPT_URL, $api_url); // API URL to connect
        curl_setopt($connection_c, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
        curl_setopt($connection_c, CURLOPT_TIMEOUT, 20);
        $json_return = curl_exec($connection_c); // connect and get json data
        curl_close($connection_c); // close connection
        return json_decode($json_return); // decode and return
    }
}