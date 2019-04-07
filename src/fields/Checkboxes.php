<?php

namespace verbb\feedme\fields;

use Cake\Utility\Hash;
use verbb\feedme\base\Field;
use verbb\feedme\base\FieldInterface;

class Checkboxes extends Field implements FieldInterface
{
    // Properties
    // =========================================================================

    public static $name = 'Checkboxes';
    public static $class = 'craft\fields\Checkboxes';


    // Templates
    // =========================================================================

    public function getMappingTemplate()
    {
        return 'feed-me/_includes/fields/option-select';
    }


    // Public Methods
    // =========================================================================

    public function parseField()
    {
        $value = $this->fetchArrayValue();

        $preppedData = [];

        $options = Hash::get($this->field, 'settings.options');
        $match = Hash::get($this->fieldInfo, 'options.match', 'value');

        foreach ($options as $option) {
            foreach ($value as $dataValue) {
                if ($dataValue === $option[$match]) {
                    $preppedData[] = $option['value'];
                }
            }
        }

        return $preppedData;
    }

}
