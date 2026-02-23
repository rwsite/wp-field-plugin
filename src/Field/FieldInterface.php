<?php

declare(strict_types=1);

namespace WpField\Field;

interface FieldInterface
{
    public function getName(): string;

    public function getType(): string;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;

    public function render(): string;

    public function sanitize(mixed $value): mixed;

    public function validate(mixed $value): bool;

    public function getAttribute(string $key, mixed $default = null): mixed;

    public function value(mixed $value): static;

    public function getValue(): mixed;
}
