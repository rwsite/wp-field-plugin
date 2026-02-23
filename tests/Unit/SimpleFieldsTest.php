<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SimpleFieldsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        require_once dirname(__DIR__, 2).'/WP_Field.php';
    }

    // ===== SWITCHER =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_switcher_with_default_parameters(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_switcher',
            'type' => 'switcher',
            'label' => 'Enable Feature',
        ], false);

        $this->assertStringContainsString('wp-field-switcher', $html);
        $this->assertStringContainsString('type="checkbox"', $html);
        $this->assertStringContainsString('value="1"', $html);
        $this->assertStringContainsString('On', $html);
        $this->assertStringContainsString('Off', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_switcher_with_custom_text(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_switcher',
            'type' => 'switcher',
            'label' => 'Enable',
            'text_on' => 'Yes',
            'text_off' => 'No',
        ], false);

        $this->assertStringContainsString('Yes', $html);
        $this->assertStringContainsString('No', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_switcher_with_checked_state(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_switcher',
            'type' => 'switcher',
            'label' => 'Enable',
            'value' => '1',
        ], false);

        $this->assertStringContainsString('checked', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_switcher_with_description(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_switcher',
            'type' => 'switcher',
            'label' => 'Enable',
            'desc' => 'Turn on/off this feature',
        ], false);

        $this->assertStringContainsString('Turn on/off this feature', $html);
        $this->assertStringContainsString('description', $html);
    }

    // ===== SPINNER =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_spinner_with_default_parameters(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_spinner',
            'type' => 'spinner',
            'label' => 'Quantity',
        ], false);

        $this->assertStringContainsString('wp-field-spinner', $html);
        $this->assertStringContainsString('wp-field-spinner-up', $html);
        $this->assertStringContainsString('wp-field-spinner-down', $html);
        $this->assertStringContainsString('type="number"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_spinner_with_min_max_step(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_spinner',
            'type' => 'spinner',
            'label' => 'Quantity',
            'min' => 1,
            'max' => 100,
            'step' => 5,
        ], false);

        $this->assertStringContainsString('min="1"', $html);
        $this->assertStringContainsString('max="100"', $html);
        $this->assertStringContainsString('step="5"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_spinner_with_unit(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_spinner',
            'type' => 'spinner',
            'label' => 'Quantity',
            'unit' => 'kg',
        ], false);

        $this->assertStringContainsString('wp-field-spinner-unit', $html);
        $this->assertStringContainsString('kg', $html);
    }

    // ===== BUTTON SET =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_button_set_with_radio(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_button_set',
            'type' => 'button_set',
            'label' => 'Alignment',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
        ], false);

        $this->assertStringContainsString('wp-field-button-set', $html);
        $this->assertStringContainsString('type="radio"', $html);
        $this->assertStringContainsString('value="left"', $html);
        $this->assertStringContainsString('Left', $html);
        $this->assertStringContainsString('value="center"', $html);
        $this->assertStringContainsString('value="right"', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_button_set_with_checkbox_multiple(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_button_set',
            'type' => 'button_set',
            'label' => 'Alignment',
            'multiple' => true,
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
        ], false);

        $this->assertStringContainsString('wp-field-button-set', $html);
        $this->assertStringContainsString('type="checkbox"', $html);
        $this->assertStringContainsString('name="test_button_set[]"', $html);
    }

    // ===== SLIDER =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_slider_with_default_parameters(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_slider',
            'type' => 'slider',
            'label' => 'Opacity',
        ], false);

        $this->assertStringContainsString('wp-field-slider-wrapper', $html);
        $this->assertStringContainsString('type="range"', $html);
        $this->assertStringContainsString('wp-field-slider', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_slider_with_show_value(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_slider',
            'type' => 'slider',
            'label' => 'Opacity',
            'show_value' => true,
            'value' => 50,
        ], false);

        $this->assertStringContainsString('wp-field-slider-value', $html);
        $this->assertStringContainsString('50', $html);
    }

    // ===== HEADING & SUBHEADING =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_heading_with_default_tag(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_heading',
            'type' => 'heading',
            'label' => 'Main Section',
        ], false);

        $this->assertStringContainsString('wp-field-heading', $html);
        $this->assertStringContainsString('<h3', $html);
        $this->assertStringContainsString('Main Section', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_subheading_with_custom_tag(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_subheading',
            'type' => 'subheading',
            'label' => 'Subsection',
            'tag' => 'h5',
        ], false);

        $this->assertStringContainsString('wp-field-subheading', $html);
        $this->assertStringContainsString('<h5', $html);
        $this->assertStringContainsString('Subsection', $html);
    }

    // ===== NOTICE =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_notice_with_type(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_notice',
            'type' => 'notice',
            'notice_type' => 'warning',
            'label' => 'This is a warning',
        ], false);

        $this->assertStringContainsString('wp-field-notice', $html);
        $this->assertStringContainsString('wp-field-notice-warning', $html);
        $this->assertStringContainsString('This is a warning', $html);
    }

    // ===== CONTENT =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_custom_content(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_content',
            'type' => 'content',
            'label' => '<div class="custom-content">Hello World</div>',
        ], false);

        $this->assertStringContainsString('custom-content', $html);
        $this->assertStringContainsString('Hello World', $html);
    }

    // ===== FIELDSET =====
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_render_fieldset_with_nested_fields(): void
    {
        $html = \WP_Field::make([
            'id' => 'test_fieldset',
            'type' => 'fieldset',
            'legend' => 'Group Info',
            'fields' => [
                [
                    'id' => 'nested_text',
                    'type' => 'text',
                    'label' => 'Nested Text',
                ],
            ],
        ], false);

        $this->assertStringContainsString('<fieldset', $html);
        $this->assertStringContainsString('<legend>', $html);
        $this->assertStringContainsString('Group Info', $html);
        $this->assertStringContainsString('Nested Text', $html);
        $this->assertStringContainsString('nested_text', $html);
    }
}
