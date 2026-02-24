<?php

declare(strict_types=1);

namespace WpField\Field\Types;

use WpField\Field\AbstractField;

abstract class ChoiceField extends AbstractField
{
    public function options(array $options): static
    {
        return $this->attribute('options', $options);
    }

    public function getOptions(): array
    {
        return $this->getAttribute('options', []);
    }
}
