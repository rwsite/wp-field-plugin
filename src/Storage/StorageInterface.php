<?php

declare(strict_types=1);

namespace WpField\Storage;

interface StorageInterface
{
    public function get(string $key, int|string $id): mixed;

    public function set(string $key, mixed $value, int|string $id): bool;

    public function delete(string $key, int|string $id): bool;

    public function exists(string $key, int|string $id): bool;
}
