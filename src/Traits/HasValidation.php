<?php

declare(strict_types=1);

namespace WpField\Traits;

trait HasValidation
{
    /** @var array<string, mixed> */
    protected array $validationRules = [];

    protected bool $isRequired = false;

    public function required(bool $required = true): static
    {
        $this->isRequired = $required;
        $this->validationRules['required'] = $required;

        return $this;
    }

    public function min(int|float $min): static
    {
        $this->validationRules['min'] = $min;

        return $this;
    }

    public function max(int|float $max): static
    {
        $this->validationRules['max'] = $max;

        return $this;
    }

    public function pattern(string $pattern): static
    {
        $this->validationRules['pattern'] = $pattern;

        return $this;
    }

    public function email(): static
    {
        $this->validationRules['email'] = true;

        return $this;
    }

    public function url(): static
    {
        $this->validationRules['url'] = true;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * @return array<string, mixed>
     */
    public function getValidationRules(): array
    {
        return $this->validationRules;
    }
}
