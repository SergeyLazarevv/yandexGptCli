<?php

namespace App\Http;

class HttpRequest
{
    /**
     * Отправка HTTP-запроса
     *
     * @param string $url URL для запроса
     * @param string $method Метод запроса: 'GET' или 'POST'
     * @param array $headers Дополнительные заголовки
     * @param array $data Данные для POST запроса
     * @return string Ответ от сервера
     */
    public static function sendRequest(string $url, string $method = 'GET', array $headers = [], array $data = []): string
    {
        $ch = curl_init();

        // Если это POST запрос, убедимся, что данные в формате JSON
        if ($method === 'POST' && $data !== null) {
            // Преобразуем данные в строку JSON
            $data = json_encode($data);
        }

        // Настройки для GET запроса
        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data); // Преобразуем массив данных в строку запроса
        }

        // Настройки cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Если POST запрос, добавляем данные
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Здесь передаем строку JSON
        }

        // Добавляем заголовки
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        // Выполнение запроса
        $response = curl_exec($ch);
        
        // Обработка ошибок cURL
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
        //var_dump('ewsp ', $response)
    }
}
