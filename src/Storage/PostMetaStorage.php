<?php

declare(strict_types=1);

namespace WpField\Storage;

class PostMetaStorage implements StorageInterface
{
    public function get(string $key, int|string $id): mixed
    {
        return get_post_meta((int) $id, $key, true);
    }

    public function set(string $key, mixed $value, int|string $id): bool
    {
        return update_post_meta((int) $id, $key, $value) !== false;
    }

    public function delete(string $key, int|string $id): bool
    {
        return delete_post_meta((int) $id, $key);
    }

    public function exists(string $key, int|string $id): bool
    {
        return metadata_exists('post', (int) $id, $key);
    }
}
