<?php

declare(strict_types=1);

namespace WpField\Field;

use WpField\Field\Types\FieldsetField;
use WpField\Field\Types\FlexibleContentField;
use WpField\Field\Types\LegacyWrapperField;
use WpField\Field\Types\MediaField;
use WpField\Field\Types\RadioField;
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

    public static function radio(string $name): RadioField
    {
        return new RadioField($name);
    }

    public static function media(string $name): MediaField
    {
        return new MediaField($name);
    }

    public static function fieldset(string $name): FieldsetField
    {
        return new FieldsetField($name);
    }

    /**
     * Create a legacy field wrapper for types not yet supported by native OOP API
     * (e.g. select, checkbox)
     */
    public static function legacy(string $type, string $name): LegacyWrapperField
    {
        return new LegacyWrapperField($name, $type);
    }

    public static function make(string $type, string $name): FieldInterface
    {
        return match ($type) {
            'text' => self::text($name),
            'repeater' => self::repeater($name),
            'flexible_content' => self::flexibleContent($name),
            'radio' => self::radio($name),
            'media' => self::media($name),
            'fieldset' => self::fieldset($name),
            default => self::legacy($type, $name),
        };
    }
}
