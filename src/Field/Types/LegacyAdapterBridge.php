<?php

declare(strict_types=1);

namespace WpField\Field\Types;

trait LegacyAdapterBridge
{
    protected function renderViaLegacy(string $legacyType): string
    {
        if (! class_exists('\WP_Field')) {
            return '';
        }

        $wrapper = new LegacyWrapperField($this->name, $legacyType);
        $wrapper->value($this->getValue());

        if ($this->isRequired()) {
            $wrapper->required();
        }

        foreach ($this->attributes as $key => $value) {
            $wrapper->attribute($key, $value);
        }

        foreach ($this->conditions as $conditionGroup) {
            foreach ($conditionGroup as $condition) {
                if (isset($condition['field'], $condition['operator'], $condition['value'])) {
                    $wrapper->when($condition['field'], $condition['operator'], $condition['value']);
                }
            }
        }

        return $wrapper->render();
    }
}
