<?php

namespace Config;

class Config
{
    public static function get(string $name)
    {
        $configs = include __DIR__ . '/configs.php';

        $keys = explode('.', $name);

        foreach ($keys as $key) {
            if (isset($configs[$key])) {
                $configs = $configs[$key];
            } else {
                return null;
            }
        }

        return $configs;
    }
}