<?php

namespace App\Helpers;

class View {
    public static function render(string $view, array $data = []): void {
        extract($data);
        require __DIR__ . "/../../views/{$view}";
    }
}
