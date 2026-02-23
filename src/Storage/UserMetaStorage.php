<?php

declare(strict_types=1);

namespace WpField\Storage;

class UserMetaStorage implements StorageInterface
{
    public function get(string $key, int|string $id): mixed
    {
        return get_user_meta((int) $id, $key, true);
    }

    public function set(string $key, mixed $value, int|string $id): bool
    {
        return update_user_meta((int) $id, $key, $value) !== false;
    }

    public function delete(string $key, int|string $id): bool
    {
        return delete_user_meta((int) $id, $key);
    }

    public function exists(string $key, int|string $id): bool
    {
        return metadata_exists('user', (int) $id, $key);
    }
}
