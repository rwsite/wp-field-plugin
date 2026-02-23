<?php

declare(strict_types=1);

namespace WpField\Field;

use WpField\Field\Types\FlexibleContentField;
use WpField\Field\Types\RepeaterField;
use WpField\Field\Types\TextField;

class Field
{
    public static function text(string $name): TextField
    {
        return new TextField($name);
    }

    public static function repeater(string $name): RepeaterField
    {
        return new RepeaterField($name);
    }

    public static function flexibleContent(string $name): FlexibleContentField
    {
        return new FlexibleContentField($name);
    }

    public static function make(string $type, string $name): FieldInterface
    {
        return match ($type) {
            'text' => self::text($name),
            'repeater' => self::repeater($name),
            'flexible_content' => self::flexibleContent($name),
            default => throw new \InvalidArgumentException("Unknown field type: {$type}"),
        };
    }
}
