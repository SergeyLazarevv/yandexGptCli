<?php

namespace App\Http;

class YandexGPTRequest
{
    private string $modelUri;
    private array $completionOptions = [
        'stream' => false,
        'temperature' => 0.6,
        'maxTokens' => '100',
        'reasoningOptions' => [
            'mode' => 'DISABLED'
        ]
    ];
    private array $messages = [];

    public function __construct(string $question, ?string $context)
    {
        $this->modelUri = 'gpt://' . $_ENV['YANDEX_CATALOG_ID'] . '/yandexgpt';
        $this->messages[] = [
            'role' => 'system',
            'text' => $question
        ];
        if($context) {
            $this->messages[] = [
                'role' => 'user',
                'text' => $context
            ];
        }
    }

    public function toJson(): string
    {
        return json_encode([
            'modelUri' => $this->modelUri,
            'completionOptions' => $this->completionOptions,
            'messages' => $this->messages
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public function toArray(): array
    {
        return [
            'modelUri' => $this->modelUri,
            'completionOptions' => $this->completionOptions,
            'messages' => $this->messages
        ];
    }
}
