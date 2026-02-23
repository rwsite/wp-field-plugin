<?php

declare(strict_types=1);

namespace WpField\Storage;

class OptionStorage implements StorageInterface
{
    public function get(string $key, int|string $id): mixed
    {
        return get_option($key, false);
    }

    public function set(string $key, mixed $value, int|string $id): bool
    {
        return update_option($key, $value);
    }

    public function delete(string $key, int|string $id): bool
    {
        return delete_option($key);
    }

    public function exists(string $key, int|string $id): bool
    {
        return get_option($key) !== false;
    }
}
