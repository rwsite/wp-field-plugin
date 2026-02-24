<?php

declare(strict_types=1);

namespace WpField\Field\Types;

use WpField\Field\AbstractField;

class LegacyWrapperField extends AbstractField
{
    private array $legacyConfig = [];

    public function __construct(string $name, string $legacyType)
    {
        parent::__construct($name, $legacyType);
    }

    /**
     * Merge additional legacy config options
     *
     * @param  array<string, mixed>  $config
     */
    public function config(array $config): static
    {
        $this->legacyConfig = array_merge($this->legacyConfig, $config);

        return $this;
    }

    public function render(): string
    {
        if (! class_exists('\WP_Field')) {
            return '';
        }

        $config = [
            'id' => $this->name,
            'type' => $this->type,
        ];

        // Map Fluent API properties to Legacy Array config
        if ($this->getAttribute('label')) {
            $config['label'] = $this->getAttribute('label');
        }

        if ($this->getAttribute('description')) {
            $config['desc'] = $this->getAttribute('description');
        }

        if ($this->getAttribute('placeholder')) {
            $config['placeholder'] = $this->getAttribute('placeholder');
        }

        if ($this->getAttribute('default')) {
            $config['default'] = $this->getAttribute('default');
        }

        if ($this->getValue() !== null) {
            $config['value'] = $this->getValue();
        }

        if ($this->isRequired()) {
            $config['required'] = true;
        }

        if ($this->getAttribute('class')) {
            $config['class'] = $this->getAttribute('class');
        }

        // Map conditions
        if (! empty($this->conditions)) {
            $config['dependency'] = [];
            foreach ($this->conditions as $conditionGroup) {
                // Legacy API uses simpler dependency arrays
                foreach ($conditionGroup as $condition) {
                    if (isset($condition['field'], $condition['operator'], $condition['value'])) {
                        $config['dependency'][] = [
                            $condition['field'],
                            $condition['operator'],
                            $condition['value'],
                        ];
                    }
                }
            }
        }

        // Add any explicitly set legacy config
        $config = array_merge($config, $this->legacyConfig);

        // Map specific field properties
        if ($this->type === 'radio' || $this->type === 'select' || $this->type === 'checkbox') {
            $options = $this->getAttribute('options');
            if ($options) {
                $config['options'] = $options;
            }
        }

        if ($this->type === 'fieldset') {
            $fields = $this->getAttribute('fields');
            if ($fields) {
                // Convert FieldInterface objects to legacy arrays if needed
                $config['fields'] = array_map(function ($field) {
                    if ($field instanceof \WpField\Field\FieldInterface) {
                        // We would need a toLegacyArray() method, but for now
                        // assume fieldsets are configured via the config() method
                        return $field->toArray();
                    }

                    return $field;
                }, $fields);
            }
        }

        // Render using the legacy API but return as string
        ob_start();
        $legacyField = new \WP_Field($config);
        $legacyField->render();
        $html = ob_get_clean();

        return $html ?: '';
    }
}
