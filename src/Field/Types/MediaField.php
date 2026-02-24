<?php

declare(strict_types=1);

namespace WpField\Field\Types;

use WpField\Field\AbstractField;

class MediaField extends AbstractField
{
    use LegacyAdapterBridge;

    public function __construct(string $name)
    {
        parent::__construct($name, 'media');
    }

    public function library(string $type): static
    {
        return $this->attribute('library', $type);
    }

    public function render(): string
    {
        return $this->renderViaLegacy('media');
    }
}
