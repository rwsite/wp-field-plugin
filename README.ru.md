<p align="center">
  <img src="wp-field.png" alt="WP_Field Screenshot" width="800">
</p>

<h1 align="center">WP_Field</h1>

<p align="center">
  <strong>Библиотека HTML-полей для WordPress</strong><br>
  Основа для создания собственных фреймворков, систем настроек и admin UI.<br>
  Fluent API, 48 уникальных типов полей (+4 алиаса), React/Vanilla UI и современная архитектура v3.
</p>

<p align="center">
  <a href="https://packagist.org/packages/rwsite/wp-field"><img src="https://img.shields.io/packagist/v/rwsite/wp-field.svg?style=flat-square" alt="Latest Version"></a>
  <img src="https://img.shields.io/badge/PHP-8.3+-blue.svg?style=flat-square" alt="PHP Version">
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-GPL--2.0--or--later-blue.svg?style=flat-square" alt="License"></a>
</p>

<p align="center">
  <a href="#возможности">Возможности</a> •
  <a href="#установка">Установка</a> •
  <a href="#быстрый-старт">Быстрый старт</a> •
  <a href="#типы-полей">Типы полей</a> •
  <a href="#примеры">Примеры</a> •
  <a href="#зависимости">Зависимости</a> •
  <a href="README.md">🇬🇧 English</a>
</p>

---

## Возможности

### v3.0 — Современный API в стиле Laravel
- ✨ **Fluent Interface** — Цепочка методов как в Laravel: `Field::text('name')->label('Имя')->required()`
- 🔁 **Repeater поля** — Бесконечная вложенность с ограничениями min/max
- 🎨 **Flexible Content** — Конструктор блоков в стиле ACF с множественными типами
- ⚛️ **React UI** — Современные React компоненты с fallback на Vanilla JS
- 🏗️ **SOLID архитектура** — Интерфейсы, трейты, внедрение зависимостей
- 📦 **Стратегии хранения** — PostMeta, TermMeta, UserMeta, Options, CustomTable
- 🛡️ **Типобезопасность** — PHPStan Level 9, строгие типы, полный PHPDoc

### Основные возможности
- 🚀 **48 уникальных типов полей** — Text, select, repeater, flexible content и другие
- ♻️ **4 алиаса совместимости** — `date_time`, `datetime-local`, `image_picker`, `imagepicker`
- 🔗 **Условная логика** — 14 операторов с отношениями AND/OR
- 🧪 **Полное покрытие тестами** — Pest/PHPUnit тесты со 100% успехом
- 🎨 **Компоненты WP** — Нативная интеграция с WordPress UI
- 🌍 **i18n Ready** — Поддержка мультиязычности

## Требования

- PHP 8.3+
- WordPress 6.0+
- Composer (для установки)

## Установка

### Через Composer (рекомендуется)

```bash
composer require rwsite/wp-field
```

### Ручная установка

1. Клонируйте или загрузите в `wp-content/plugins/wp-field-plugin`
2. Запустите `composer install --no-dev`
3. Активируйте плагин в админ-панели WordPress

### Сборка React компонентов (опционально)

```bash
npm install
npm run build
```

## Быстрый старт

### Современный API (v3.0)

```php
use WpField\Field\Field;
use WpField\Container\MetaboxContainer;

// Fluent интерфейс
$field = Field::text('email')
    ->label('Email адрес')
    ->placeholder('user@example.com')
    ->required()
    ->email()
    ->class('regular-text');

// Рендер поля
echo $field->render();

// Создание метабокса с полями
$metabox = new MetaboxContainer('product_details', [
    'title' => 'Детали продукта',
    'post_types' => ['product'],
]);

$metabox->addField(
    Field::text('sku')->label('Артикул')->required()
);

$metabox->addField(
    Field::text('price')->label('Цена')->required()
);

$metabox->register();
```

### Repeater поле

```php
$repeater = Field::repeater('team_members')
    ->label('Члены команды')
    ->fields([
        Field::text('name')->label('Имя')->required(),
        Field::text('position')->label('Должность'),
        Field::text('email')->label('Email')->email(),
    ])
    ->min(1)
    ->max(10)
    ->buttonLabel('Добавить участника')
    ->layout('table');
```

### Flexible Content поле

```php
$flexible = Field::flexibleContent('page_sections')
    ->label('Секции страницы')
    ->addLayout('text_block', 'Текстовый блок', [
        Field::text('heading')->label('Заголовок'),
        Field::text('content')->label('Содержимое'),
    ])
    ->addLayout('image', 'Изображение', [
        Field::text('image_url')->label('URL изображения')->url(),
        Field::text('caption')->label('Подпись'),
    ])
    ->min(1)
    ->buttonLabel('Добавить секцию');
```

## Типы полей (48 уникальных + 4 алиаса)

### Базовые (9)
- `text` — Текстовый ввод
- `password` — Поле пароля
- `email` — Email ввод
- `url` — URL ввод
- `tel` — Телефонный ввод
- `number` — Числовой ввод
- `range` — Ползунок диапазона
- `hidden` — Скрытое поле
- `textarea` — Многострочный текст

### Выборные (5)
- `select` — Выпадающий список
- `multiselect` — Множественный выбор
- `radio` — Радиокнопки
- `checkbox` — Одиночный чекбокс
- `checkbox_group` — Группа чекбоксов

### Продвинутые (9)
- `editor` — wp_editor
- `media` — Медиа библиотека (ID или URL)
- `image` — Изображение с превью
- `file` — Загрузка файла
- `gallery` — Галерея изображений
- `color` — Выбор цвета
- `date` — Выбор даты
- `time` — Выбор времени
- `datetime` — Дата и время

### Композитные (2)
- `group` — Вложенные поля
- `repeater` — Повторяющиеся элементы

### Простые поля (9)
- `switcher` — Переключатель вкл/выкл
- `spinner` — Счетчик чисел
- `button_set` — Выбор кнопками
- `slider` — Ползунок значения
- `heading` — Заголовок
- `subheading` — Подзаголовок
- `notice` — Уведомление (info/success/warning/error)
- `content` — Произвольный HTML контент
- `fieldset` — Группировка полей

### Поля средней сложности (10)
- `accordion` — Сворачиваемые секции
- `tabbed` — Вкладки
- `typography` — Настройки типографии
- `spacing` — Контролы отступов
- `dimensions` — Контролы размеров
- `border` — Настройки границы
- `background` — Опции фона
- `link_color` — Цвета ссылок
- `color_group` — Группа цветов
- `image_select` — Выбор изображений

### Поля высокой сложности (8)
- `code_editor` — Редактор кода с подсветкой синтаксиса
- `icon` — Выбор иконки из библиотеки
- `map` — Карта Google Maps с выбором координат
- `sortable` — Сортировка drag & drop
- `sorter` — Сортировка enabled/disabled
- `palette` — Палитра цветов
- `link` — Поле ссылки (URL + текст + target)
- `backup` — Экспорт/импорт настроек

## Примеры

### Зависимости

```php
// Показать поле только если другое поле имеет определенное значение
WP_Field::make([
    'id'    => 'courier_address',
    'type'  => 'text',
    'label' => 'Адрес доставки',
    'dependency' => [
        ['delivery_type', '==', 'courier'],
    ],
]);

// Множественные условия (AND)
WP_Field::make([
    'id'    => 'special_field',
    'type'  => 'text',
    'label' => 'Специальное поле',
    'dependency' => [
        ['field1', '==', 'value1'],
        ['field2', '!=', 'value2'],
        'relation' => 'AND',
    ],
]);

// Множественные условия (OR)
WP_Field::make([
    'id'    => 'notification',
    'type'  => 'text',
    'label' => 'Уведомление',
    'dependency' => [
        ['type', '==', 'sms'],
        ['type', '==', 'email'],
        'relation' => 'OR',
    ],
]);
```

### Repeater

```php
WP_Field::make([
    'id'       => 'work_times',
    'type'     => 'repeater',
    'label'    => 'Время работы',
    'min'      => 1,
    'max'      => 7,
    'add_text' => 'Добавить день',
    'fields'   => [
        [
            'id'      => 'day',
            'type'    => 'select',
            'label'   => 'День',
            'options' => ['mon' => 'Пн', 'tue' => 'Вт'],
        ],
        [
            'id'    => 'from',
            'type'  => 'time',
            'label' => 'С',
        ],
        [
            'id'    => 'to',
            'type'  => 'time',
            'label' => 'По',
        ],
    ],
]);
```

### Group

```php
WP_Field::make([
    'id'    => 'address',
    'type'  => 'group',
    'label' => 'Адрес',
    'fields' => [
        ['id' => 'city', 'type' => 'text', 'label' => 'Город'],
        ['id' => 'street', 'type' => 'text', 'label' => 'Улица'],
        ['id' => 'number', 'type' => 'text', 'label' => 'Номер'],
    ],
]);
```

### Code Editor

```php
WP_Field::make([
    'id'     => 'custom_css',
    'type'   => 'code_editor',
    'label'  => 'Custom CSS',
    'mode'   => 'css', // css, javascript, php, html
    'height' => '400px',
]);
```

### Icon Picker

```php
WP_Field::make([
    'id'      => 'menu_icon',
    'type'    => 'icon',
    'label'   => 'Иконка меню',
    'library' => 'dashicons',
]);
```

### Map

```php
WP_Field::make([
    'id'      => 'location',
    'type'    => 'map',
    'label'   => 'Местоположение',
    'api_key' => 'YOUR_GOOGLE_MAPS_API_KEY',
    'zoom'    => 12,
    'center'  => ['lat' => 55.7558, 'lng' => 37.6173],
]);
```

### Sortable

```php
WP_Field::make([
    'id'      => 'menu_order',
    'type'    => 'sortable',
    'label'   => 'Порядок меню',
    'options' => [
        'home'     => 'Главная',
        'about'    => 'О нас',
        'services' => 'Услуги',
        'contact'  => 'Контакты',
    ],
]);
```

### Palette

```php
WP_Field::make([
    'id'       => 'color_scheme',
    'type'     => 'palette',
    'label'    => 'Цветовая схема',
    'palettes' => [
        'blue'   => ['#0073aa', '#005a87', '#003d82'],
        'green'  => ['#28a745', '#218838', '#1e7e34'],
        'red'    => ['#dc3545', '#c82333', '#bd2130'],
    ],
]);
```

### Link

```php
WP_Field::make([
    'id'    => 'cta_button',
    'type'  => 'link',
    'label' => 'CTA кнопка',
]);

// Получение значения:
$link = get_post_meta($post_id, 'cta_button', true);
// ['url' => '...', 'text' => '...', 'target' => '_blank']
```

### Accordion

```php
WP_Field::make([
    'id'       => 'settings_accordion',
    'type'     => 'accordion',
    'label'    => 'Настройки',
    'sections' => [
        [
            'title'  => 'Основные',
            'open'   => true,
            'fields' => [
                ['id' => 'title', 'type' => 'text', 'label' => 'Заголовок'],
            ],
        ],
        [
            'title'  => 'Дополнительные',
            'fields' => [
                ['id' => 'desc', 'type' => 'textarea', 'label' => 'Описание'],
            ],
        ],
    ],
]);
```

### Typography

```php
WP_Field::make([
    'id'    => 'heading_typography',
    'type'  => 'typography',
    'label' => 'Типография заголовков',
]);

// Сохраняется как:
// [
//     'font_family' => 'Arial',
//     'font_size' => '24',
//     'font_weight' => '700',
//     'line_height' => '1.5',
//     'text_align' => 'center',
//     'color' => '#333333'
// ]
```

## Операторы зависимостей

- `==` — Равно
- `!=` — Не равно
- `>`, `>=`, `<`, `<=` — Сравнение
- `in` — В массиве
- `not_in` — Не в массиве
- `contains` — Содержит
- `not_contains` — Не содержит
- `empty` — Пусто
- `not_empty` — Не пусто

## Интерактивная демонстрация

**Посмотрите все 48 типов полей в действии:**

👉 **Инструменты → WP_Field Examples** (демо классического API)  
👉 `/wp-admin/tools.php?page=wp-field-examples`

👉 **Инструменты → WP_Field v3.0 Demo** (Modern Fluent API)  
👉 `/wp-admin/tools.php?page=wp-field-v3-demo`

Демо-страницы включают:
- ✅ Все 48 типов полей с живыми примерами
- ✅ Код для каждого поля
- ✅ Демонстрации Fluent API (v3.0)
- ✅ Примеры Repeater и Flexible Content
- ✅ Условную логику с 14 операторами
- ✅ Переключение React/Vanilla UI
- ✅ Демонстрацию системы зависимостей
- ✅ Возможность сохранить и протестировать

## Расширяемость

### Добавление своих типов полей

```php
add_filter('wp_field_types', function($types) {
    $types['custom_type'] = ['render_custom', ['default' => 'value']];
    return $types;
});
```

### Добавление библиотек иконок

```php
add_filter('wp_field_icon_library', function($icons, $library) {
    if ($library === 'fontawesome') {
        return ['fa-home', 'fa-user', 'fa-cog', ...];
    }
    return $icons;
}, 10, 2);
```

### Кастомное получение значений

```php
add_filter('wp_field_get_value', function($value, $storage_type, $key, $id, $field) {
    if ($storage_type === 'custom') {
        return get_custom_value($key, $id);
    }
    return $value;
}, 10, 5);
```

## Changelog

Смотрите **[CHANGELOG.md](CHANGELOG.md)** для подробной истории версий.

## Статистика проекта

- **Строк PHP:** 2705 (WP_Field.php)
- **Строк JS:** 1222 (wp-field.js)
- **Строк CSS:** 1839 (wp-field.css)
- **Типов полей:** 48
- **Операторов зависимостей:** 12
- **Типов хранилищ:** 5
- **Внешних зависимостей:** 0

## Совместимость

- **WordPress:** 6.0+
- **PHP:** 8.3+
- **Зависимости:** jQuery, jQuery UI Sortable, встроенные компоненты WordPress
- **Браузеры:** Chrome, Firefox, Safari, Edge (последние 2 версии)

## Производительность

- Минимальный размер CSS: ~20KB
- Минимальный размер JS: ~15KB
- Lazy loading для тяжелых компонентов (CodeMirror, Google Maps)
- Оптимизированные селекторы и события

## Лицензия

GPL v2 или выше

## Автор

Aleksei Tikhomirov (https://rwsite.ru)
