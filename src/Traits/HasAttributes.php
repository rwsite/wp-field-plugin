<?php

declare(strict_types=1);

namespace WpField\Traits;

trait HasAttributes
{
    /** @var array<string, mixed> */
    protected array $attributes = [];

    public function label(string $label): static
    {
        $this->attributes['label'] = $label;

        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->attributes['placeholder'] = $placeholder;

        return $this;
    }

    public function description(string $description): static
    {
        $this->attributes['description'] = $description;

        return $this;
    }

    public function default(mixed $default): static
    {
        $this->attributes['default'] = $default;

        return $this;
    }

    public function class(string $class): static
    {
        $this->attributes['class'] = $class;

        return $this;
    }

    public function id(string $id): static
    {
        $this->attributes['id'] = $id;

        return $this;
    }

    public function disabled(bool $disabled = true): static
    {
        $this->attributes['disabled'] = $disabled;

        return $this;
    }

    public function readonly(bool $readonly = true): static
    {
        $this->attributes['readonly'] = $readonly;

        return $this;
    }

    public function getAttribute(string $key, mixed $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttribute(string $key, mixed $value): static
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function attribute(string $key, mixed $value): static
    {
        return $this->setAttribute($key, $value);
    }
}
