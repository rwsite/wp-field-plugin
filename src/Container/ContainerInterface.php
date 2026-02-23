<?php

declare(strict_types=1);

namespace WpField\Container;

use WpField\Field\FieldInterface;

interface ContainerInterface
{
    public function addField(FieldInterface $field): static;

    /**
     * @return array<string, FieldInterface>
     */
    public function getFields(): array;

    public function register(): void;

    public function render(): void;

    public function save(int|string $id): void;
}
