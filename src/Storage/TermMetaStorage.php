<?php

declare(strict_types=1);

namespace WpField\Storage;

class TermMetaStorage implements StorageInterface
{
    public function get(string $key, int|string $id): mixed
    {
        return get_term_meta((int) $id, $key, true);
    }

    public function set(string $key, mixed $value, int|string $id): bool
    {
        return update_term_meta((int) $id, $key, $value) !== false;
    }

    public function delete(string $key, int|string $id): bool
    {
        return delete_term_meta((int) $id, $key);
    }

    public function exists(string $key, int|string $id): bool
    {
        return metadata_exists('term', (int) $id, $key);
    }
}
