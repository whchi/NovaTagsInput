<?php

namespace Whchi\NovaTagsInput;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tags extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-tags-input';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->withMeta([
            'props' => config('nova_tags_input.props'),
            'style_variables' => config('nova_tags_input.style_variables')
        ]);
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {

            $attributes = json_decode($request[$requestAttribute], true);

            $tags = json_encode(array_map(function ($attr) {
                return ['text' => $attr['text']];
            }, $attributes), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

            $model->{$attribute} = $tags;
        }
    }

    public function autocompleteItems(array $items)
    {
        /*
         * Convert the user's items to the required syntax
         */
        $entries = [];
        foreach ($items as $item) {
            $entries[] = ['text' => $item];
        }
        return $this->withMeta(['autocompleteItems' => $entries]);
    }
}
