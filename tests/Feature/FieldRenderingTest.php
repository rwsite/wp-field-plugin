<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

class FieldRenderingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        require_once dirname(__DIR__, 2).'/WP_Field.php';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_text_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_text',
            'type' => 'text',
            'label' => 'Test Text',
        ], false);

        $this->assertStringContainsString('wp-field', $html);
        $this->assertStringContainsString('test_text', $html);
        $this->assertStringContainsString('Test Text', $html);
        $this->assertStringContainsString('type="text"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_select_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_select',
            'type' => 'select',
            'label' => 'Test Select',
            'options' => ['a' => 'Option A', 'b' => 'Option B'],
        ], false);

        $this->assertStringContainsString('<select', $html);
        $this->assertStringContainsString('Option A', $html);
        $this->assertStringContainsString('Option B', $html);
        $this->assertStringContainsString('test_select', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_radio_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_radio',
            'type' => 'radio',
            'label' => 'Test Radio',
            'options' => ['yes' => 'Yes', 'no' => 'No'],
        ], false);

        $this->assertStringContainsString('type="radio"', $html);
        $this->assertStringContainsString('Yes', $html);
        $this->assertStringContainsString('No', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_checkbox_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_checkbox',
            'type' => 'checkbox',
            'label' => 'Test Checkbox',
        ], false);

        $this->assertStringContainsString('type="checkbox"', $html);
        $this->assertStringContainsString('test_checkbox', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_textarea_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_textarea',
            'type' => 'textarea',
            'label' => 'Test Textarea',
        ], false);

        $this->assertStringContainsString('<textarea', $html);
        $this->assertStringContainsString('test_textarea', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_number_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_number',
            'type' => 'number',
            'label' => 'Test Number',
            'min' => 0,
            'max' => 100,
        ], false);

        $this->assertStringContainsString('type="number"', $html);
        $this->assertStringContainsString('min="0"', $html);
        $this->assertStringContainsString('max="100"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_email_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_email',
            'type' => 'email',
            'label' => 'Test Email',
        ], false);

        $this->assertStringContainsString('type="email"', $html);
        $this->assertStringContainsString('test_email', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_color_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_color',
            'type' => 'color',
            'label' => 'Test Color',
        ], false);

        $this->assertStringContainsString('wp-color-picker-field', $html);
        $this->assertStringContainsString('test_color', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_date_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_date',
            'type' => 'date',
            'label' => 'Test Date',
        ], false);

        $this->assertStringContainsString('type="date"', $html);
        $this->assertStringContainsString('test_date', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_time_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_time',
            'type' => 'time',
            'label' => 'Test Time',
        ], false);

        $this->assertStringContainsString('type="time"', $html);
        $this->assertStringContainsString('test_time', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_field_with_placeholder(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_field',
            'type' => 'text',
            'label' => 'Test',
            'placeholder' => 'Enter value',
        ], false);

        $this->assertStringContainsString('placeholder="Enter value"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_field_with_description(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_field',
            'type' => 'text',
            'label' => 'Test',
            'desc' => 'This is a description',
        ], false);

        $this->assertStringContainsString('This is a description', $html);
        $this->assertStringContainsString('description', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_field_with_custom_class(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_field',
            'type' => 'text',
            'label' => 'Test',
            'class' => 'my-custom-class',
        ], false);

        $this->assertStringContainsString('my-custom-class', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_field_with_custom_attributes(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_field',
            'type' => 'text',
            'label' => 'Test',
            'custom_attributes' => ['data-test' => 'value', 'aria-label' => 'Test Label'],
        ], false);

        $this->assertStringContainsString('data-test="value"', $html);
        $this->assertStringContainsString('aria-label="Test Label"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_readonly_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_field',
            'type' => 'text',
            'label' => 'Test',
            'readonly' => true,
        ], false);

        $this->assertStringContainsString('readonly', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_disabled_field(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_field',
            'type' => 'text',
            'label' => 'Test',
            'disabled' => true,
        ], false);

        $this->assertStringContainsString('disabled', $html);
    }
}
