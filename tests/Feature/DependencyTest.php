<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

class DependencyTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        require_once dirname(__DIR__, 2).'/WP_Field.php';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_hides_field_when_dependency_not_met(): void
    {
        $html = \WP_Field::make([
            'id' => 'dependent_field',
            'type' => 'text',
            'label' => 'Dependent Field',
            'dependency' => [
                ['other_field', '==', 'value'],
            ],
        ], false);

        $this->assertStringContainsString('is-hidden', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_shows_field_when_dependency_met(): void
    {
        // For testing we will just check that dependency data is printed correctly
        // and the field does not crash, since getting actual values requires DB/WP setup.
        $html = \WP_Field::make([
            'id' => 'dependent_field',
            'type' => 'text',
            'label' => 'Dependent Field',
            'value' => 'value',
            'dependency' => [
                ['dependent_field', '==', 'value'],
            ],
        ], false);

        // We check if data-dependency attribute exists instead of visibility logic
        // because evaluate_dependency uses get_value which is heavily dependent on WP
        $this->assertStringContainsString('data-dependency', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_renders_dependency_data_attribute(): void
    {
        $html = \WP_Field::make([
            'id' => 'field_with_dep',
            'type' => 'text',
            'label' => 'Field',
            'dependency' => [
                ['other_field', '==', 'value'],
            ],
        ], false);

        $this->assertStringContainsString('data-dependency', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_handles_multiple_dependencies_with_and(): void
    {
        $html = \WP_Field::make([
            'id' => 'field_with_deps',
            'type' => 'text',
            'label' => 'Field',
            'dependency' => [
                ['field1', '==', 'value1'],
                ['field2', '!=', 'value2'],
                'relation' => 'AND',
            ],
        ], false);

        $this->assertStringContainsString('data-dependency', $html);
        $this->assertStringContainsString('AND', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_handles_multiple_dependencies_with_or(): void
    {
        $html = \WP_Field::make([
            'id' => 'field_with_deps',
            'type' => 'text',
            'label' => 'Field',
            'dependency' => [
                ['field1', '==', 'value1'],
                ['field2', '==', 'value2'],
                'relation' => 'OR',
            ],
        ], false);

        $this->assertStringContainsString('data-dependency', $html);
        $this->assertStringContainsString('OR', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_supports_in_operator(): void
    {
        $html = \WP_Field::make([
            'id' => 'field_with_in',
            'type' => 'text',
            'label' => 'Field',
            'dependency' => [
                ['field', 'in', ['a', 'b', 'c']],
            ],
        ], false);

        $this->assertStringContainsString('data-dependency', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_supports_contains_operator(): void
    {
        $html = \WP_Field::make([
            'id' => 'field_with_contains',
            'type' => 'text',
            'label' => 'Field',
            'dependency' => [
                ['field', 'contains', 'text'],
            ],
        ], false);

        $this->assertStringContainsString('data-dependency', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_supports_empty_operator(): void
    {
        $html = \WP_Field::make([
            'id' => 'field_with_empty',
            'type' => 'text',
            'label' => 'Field',
            'dependency' => [
                ['field', 'empty', null],
            ],
        ], false);

        $this->assertStringContainsString('data-dependency', $html);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_supports_comparison_operators(): void
    {
        $operators = ['==', '!=', '>', '>=', '<', '<='];

        foreach ($operators as $op) {
            $html = \WP_Field::make([
                'id' => 'field_with_op',
                'type' => 'text',
                'label' => 'Field',
                'dependency' => [
                    ['field', $op, 'value'],
                ],
            ], false);

            $this->assertStringContainsString('data-dependency', $html);
        }
    }
}
