<?php

class YandexClient {

    public static function getYandexIamToken(string $oauthToken) {

        $url = 'https://iam.api.cloud.yandex.net/iam/v1/tokens';
        $data = json_encode(['yandexPassportOauthToken' => $oauthToken]);
        $ch = curl_init($url);
    
        // Установка параметров cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Возвращать результат в переменную
        curl_setopt($ch, CURLOPT_POST, true); // Устанавливаем POST метод
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Передаем данные
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json', // Устанавливаем заголовок Content-Type
        ]);
    
        // Выполнение запроса
        $response = curl_exec($ch);
    
        // Проверка на ошибку
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
    
        // Закрытие сессии cURL
        curl_close($ch);
    
        // Возврат ответа
        return json_decode($response, true); // Преобразуем JSON в ассоциативный массив
    }
    
    // // Пример вызова
    // $oauthToken = '<OAuth-токен>';  // Замените на ваш OAuth токен
    // $response = getYandexToken($oauthToken);
    
    // Выводим результат
    // print_r($response);
}