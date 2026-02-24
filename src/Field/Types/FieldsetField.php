<?php

declare(strict_types=1);

namespace WpField\Field\Types;

use WpField\Field\AbstractField;

class FieldsetField extends AbstractField
{
    use LegacyAdapterBridge;

    public function __construct(string $name)
    {
        parent::__construct($name, 'fieldset');
    }

    public function fields(array $fields): static
    {
        return $this->attribute('fields', $fields);
    }

    public function render(): string
    {
        return $this->renderViaLegacy('fieldset');
    }
}
