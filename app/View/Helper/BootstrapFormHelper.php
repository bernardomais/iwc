<?php

App::uses('FormHelper', 'View/Helper');

class BootstrapFormHelper extends FormHelper {

    public function addClass($options = array(), $class = null, $key = 'class') {
        if ($class === 'error') {
            $class = 'has-error has-feedback';
        }
        return parent::addClass($options, $class, $key);
    }

    public function checkboxes($fieldName, $attributes = array()) {
        $options = isset($attributes['options']) ? $attributes['options'] : array();
        $checkboxes = array();
        $checkboxes[] = '<fieldset>';
        unset($attributes['options']);
        if (!empty($options)) {
            if (!empty($attributes['legend'])) {
                $checkboxes[] = sprintf('<legend class="as-label">%s</legend>', $attributes['legend']);
            }

            foreach ($options as $key => $option) {
                $inputOptions = array('label' => false, 'div' => false, 'type' => 'checkbox', 'value' => $key, 'before' => '<div class="checkbox"><label>', 'after' => sprintf('&nbsp;%s</label></div>', $option));
                if (!empty($attributes['selected'])) {
                    $inputOptions['checked'] = in_array($key, $attributes['selected']);
                }

                $checkboxes[] = $this->input($fieldName . '.' . $key, $inputOptions);
            }
        }
        $checkboxes[] = '</fieldset>';

        $output = implode('', $checkboxes);

        return $output;
    }

}
