<?php

declare(strict_types=1);

namespace WpField\Field\Types;

class RadioField extends ChoiceField
{
    use LegacyAdapterBridge;

    public function __construct(string $name)
    {
        parent::__construct($name, 'radio');
    }

    public function render(): string
    {
        return $this->renderViaLegacy('radio');
    }
}
