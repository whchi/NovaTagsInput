![](https://img.shields.io/packagist/dt/whchi/nova-tags-input?style=flat-square) ![](https://img.shields.io/packagist/v/whchi/nova-tags-input?style=flat-square&color=blue)


# About
A simple wrapper of [vue-tags-input](http://www.vue-tags-input.com) for laravel nova

# Installation
```sh
composer require whchi/nova-tags-input
```

# Example
```php
use Whchi\NovaTagsInput\Tags;
...
  Tags::make('tags')->autocompleteItems(['tag1', 'tag2'])
```
# config publish
```sh
php artisan vendor:publish --provider="Whchi\NovaTagsInput\FieldServiceProvider"
```
change whatever you want in `config/nova_tags_input.php`
```php
return [
    'classes' => '',
    'props' => [
        'add-from-paste' => true,
        'add-on-blur' => true,
        'add-on-key' => [13],
        'add-only-from-autocomplete' => false,
        'allow-edit-tags' => false,
        'autocomplete-always-open' => false,
        'autocomplete-filter-duplicates' => true,
        'autocomplete-min-length' => 1,
        'avoid-adding-duplicates' => true,
        'delete-on-backspace' => true,
        'disabled' => false,
        'max-tags' => null,
        'maxlength' => null,
        'placeholder' => 'Add Tag',
        'save-on-key' => [13, ':', ';'],
        'separators' => [';'],
    ],
];

```
* available props
see http://www.vue-tags-input.com/#/api/props

# notice
Better use `json` column for your database.

Below is an example saving in your column
```json
[{"text": "test"}, {"text": "中文字串"}]
```
# TODO
- [ ] support custom css class
