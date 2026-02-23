<?php

declare(strict_types=1);

use WpField\Field\Field;

it('Field::text creates a TextField with correct properties', function (): void {
    $field = Field::text('name')
        ->required()
        ->label('Имя');

    expect($field->toArray())
        ->toMatchArray([
            'type' => 'text',
            'required' => true,
            'label' => 'Имя',
        ]);
});

it('Field can chain multiple attributes', function (): void {
    $field = Field::text('email')
        ->label('Email')
        ->placeholder('example@example.com')
        ->required()
        ->email()
        ->class('form-control');

    $array = $field->toArray();

    expect($array)
        ->toHaveKey('type', 'text')
        ->toHaveKey('label', 'Email')
        ->toHaveKey('placeholder', 'example@example.com')
        ->toHaveKey('required', true)
        ->toHaveKey('class', 'form-control');
});

it('Field validates required values correctly', function (): void {
    $field = Field::text('name')->required();

    expect($field->validate(''))->toBeFalse()
        ->and($field->validate('John'))->toBeTrue();
});

it('Field validates email correctly', function (): void {
    $field = Field::text('email')->email();

    expect($field->validate('invalid-email'))->toBeFalse()
        ->and($field->validate('valid@example.com'))->toBeTrue();
});

it('Field validates min/max correctly', function (): void {
    $field = Field::text('age')->min(18)->max(100);

    expect($field->validate(17))->toBeFalse()
        ->and($field->validate(18))->toBeTrue()
        ->and($field->validate(50))->toBeTrue()
        ->and($field->validate(100))->toBeTrue()
        ->and($field->validate(101))->toBeFalse();
});

it('Field renders HTML correctly', function (): void {
    $field = Field::text('username')
        ->label('Username')
        ->placeholder('Enter username')
        ->required();

    $html = $field->render();

    expect($html)
        ->toContain('type="text"')
        ->toContain('name="username"')
        ->toContain('placeholder="Enter username"')
        ->toContain('required')
        ->toContain('<label');
});

it('Field sanitizes values', function (): void {
    $field = Field::text('name');

    $sanitized = $field->sanitize('<script>alert("xss")</script>');

    expect($sanitized)->not->toContain('<script>');
});

it('Field supports default values', function (): void {
    $field = Field::text('country')->default('USA');

    expect($field->getValue())->toBe('USA');
});

it('Field supports conditional logic', function (): void {
    $field = Field::text('city')
        ->when('country', '==', 'USA')
        ->orWhen('country', '==', 'Canada');

    $conditions = $field->getConditions();

    expect($conditions)
        ->toHaveCount(2)
        ->and($conditions[0])->toMatchArray([
            'field' => 'country',
            'operator' => '==',
            'value' => 'USA',
            'logic' => 'AND',
        ])
        ->and($conditions[1])->toMatchArray([
            'field' => 'country',
            'operator' => '==',
            'value' => 'Canada',
            'logic' => 'OR',
        ]);
});
