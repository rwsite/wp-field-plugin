<?php

declare(strict_types=1);

namespace WpField\Legacy;

use WpField\Field\Field;
use WpField\Field\FieldInterface;

class LegacyAdapter
{
    /**
     * @param  array<string, mixed>  $config
     */
    public static function make(array $config): FieldInterface
    {
        $type = $config['type'] ?? 'text';
        $name = $config['id'] ?? $config['name'] ?? '';

        if (empty($name)) {
            throw new \InvalidArgumentException('Field name/id is required');
        }

        $field = Field::make($type, $name);

        if (isset($config['label'])) {
            $field->label((string) $config['label']);
        }

        if (isset($config['title']) && ! isset($config['label'])) {
            $field->label((string) $config['title']);
        }

        if (isset($config['placeholder'])) {
            $field->placeholder((string) $config['placeholder']);
        }

        if (isset($config['description']) || isset($config['desc'])) {
            $desc = $config['description'] ?? $config['desc'];
            $field->description((string) $desc);
        }

        if (isset($config['default'])) {
            $field->default($config['default']);
        }

        if (isset($config['value']) || isset($config['val'])) {
            $value = $config['value'] ?? $config['val'];
            $field->value($value);
        }

        if (isset($config['class'])) {
            $field->class((string) $config['class']);
        }

        if (isset($config['required']) && $config['required']) {
            $field->required();
        }

        if (isset($config['readonly']) && $config['readonly']) {
            $field->readonly();
        }

        if (isset($config['disabled']) && $config['disabled']) {
            $field->disabled();
        }

        if (isset($config['attributes']) || isset($config['attr']) || isset($config['atts'])) {
            $attrs = $config['attributes'] ?? $config['attr'] ?? $config['atts'];
            if (is_array($attrs)) {
                foreach ($attrs as $key => $value) {
                    $field->attribute((string) $key, $value);
                }
            }
        }

        if (isset($config['validation'])) {
            self::applyValidation($field, $config['validation']);
        }

        if (isset($config['conditional_logic']) || isset($config['conditions'])) {
            $conditions = $config['conditional_logic'] ?? $config['conditions'];
            self::applyConditionalLogic($field, $conditions);
        }

        return $field;
    }

    /**
     * @param  array<string, mixed>|string  $validation
     */
    protected static function applyValidation(FieldInterface $field, array|string $validation): void
    {
        if (is_string($validation)) {
            $rules = explode('|', $validation);
            foreach ($rules as $rule) {
                self::applyValidationRule($field, $rule);
            }
        } elseif (is_array($validation)) {
            foreach ($validation as $rule => $value) {
                if (is_numeric($rule)) {
                    self::applyValidationRule($field, (string) $value);
                } else {
                    self::applyValidationRule($field, $rule, $value);
                }
            }
        }
    }

    protected static function applyValidationRule(FieldInterface $field, string $rule, mixed $value = true): void
    {
        $parts = explode(':', $rule);
        $ruleName = $parts[0];
        $ruleValue = $parts[1] ?? $value;

        match ($ruleName) {
            'required' => $field->required(),
            'email' => $field->email(),
            'url' => $field->url(),
            'min' => is_numeric($ruleValue) ? $field->min((int) $ruleValue) : null,
            'max' => is_numeric($ruleValue) ? $field->max((int) $ruleValue) : null,
            'pattern' => is_string($ruleValue) ? $field->pattern($ruleValue) : null,
            default => null,
        };
    }

    /**
     * @param  array<array<string, mixed>>  $conditions
     */
    protected static function applyConditionalLogic(FieldInterface $field, array $conditions): void
    {
        foreach ($conditions as $condition) {
            $targetField = $condition['field'] ?? '';
            $operator = $condition['operator'] ?? '==';
            $value = $condition['value'] ?? '';

            if (! empty($targetField)) {
                $field->when($targetField, $operator, $value);
            }
        }
    }

    /**
     * @param  array<array<string, mixed>>  $fields
     * @return array<FieldInterface>
     */
    public static function makeMultiple(array $fields): array
    {
        $result = [];
        foreach ($fields as $fieldConfig) {
            if (is_array($fieldConfig)) {
                $result[] = self::make($fieldConfig);
            }
        }

        return $result;
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public static function render(array $config): string
    {
        $field = self::make($config);

        return $field->render();
    }

    /**
     * @param  array<array<string, mixed>>  $fields
     */
    public static function renderMultiple(array $fields): string
    {
        $html = '';
        foreach ($fields as $fieldConfig) {
            if (is_array($fieldConfig)) {
                $html .= self::render($fieldConfig);
            }
        }

        return $html;
    }
}
