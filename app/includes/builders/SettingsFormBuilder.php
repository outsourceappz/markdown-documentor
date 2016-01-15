<?php

require_once __DIR__ . '/FormBuilder.php';

/**
 * Form builder for WordPress Settings Page.
 */
class Markdown_Documenter_SettingsFormBuilder extends Markdown_Documenter_FormBuilder
{

    public function wrap()
    {
        return "<div class='wrap'>";
    }

    public function closeWrap()
    {
        return "</div>";
    }

    public function title($name)
    {
        return "<h2>$name</h2>";
    }

    public function section($name, $description = null)
    {
        $html = "<h3 class='title'>$name<h3>";

        if ($description) {
            $html .= "<p class='description'>$description</p>";
        }

        return $html;
    }

    public function openTable()
    {
        return "<table class='form-table'>";
    }

    public function closeTable()
    {
        return "</table>";
    }

    /**
     * Create a form input field.
     *
     * @param  string $type
     * @param  string $name
     * @param  string $value
     * @param  array  $options
     * @return string
     */
    public function input($type, $name, $value = null, $options = array())
    {
        $html = parent::input($type, $name, $value, $options);

        $wrap = true;

        if (isset($options['escapeWrap'])) {
            $wrap = false;
        }

        if ($wrap) {
            $this->wrapDescription($html, $options);

            return $this->wrapRow($options['label'], $html);
        } else {
            return $html;
        }
    }

    protected function wrapRow($label, $html)
    {
        $row = "<tr>";
        $row .= "<th scope='row'>" ;
        $row .= $label;
        $row .= '</th>';
        $row .= '<td>';
        $row .= $html;
        $row .= '</td>';
        $row .= '</tr>';

        return $row;
    }

    public function select($name, $list = array(), $selected = null, $options = array())
    {
        $html = parent::select($name, $list, $selected, $options);

        $this->wrapDescription($html, $options);

        return $this->wrapRow($options['label'], $html);
    }

    public function checkbox($name, $list = array(), $selected = array(), $options = array())
    {
        if(is_string($selected)){
            $selected = array($selected);
        }

        $html     = '';
        $defaults = ['escapeWrap' => true];
        foreach ($list as $key => $value) {
            $html .= parent::checkbox($name . '[]', $key, in_array($key, $selected), array_merge($defaults, $options));
            $html .= sprintf("&nbsp;<span>%s</span>&nbsp;", $value);
        }

        $this->wrapDescription($html, $options);

        return $this->wrapRow($options['label'], $html);
    }

    public function radio($name, $list = array(), $selected = null, $options = array())
    {
        $html     = '';
        $defaults = ['escapeWrap' => true];
        foreach ($list as $key => $value) {
            $html .= parent::radio($name, $key, $selected == $key, array_merge($defaults, $options));
            $html .= sprintf("&nbsp;<span>%s</span>&nbsp;", $value);
        }

        $this->wrapDescription($html, $options);

        return $this->wrapRow($options['label'], $html);
    }

    public function textarea($name, $value = null, $options = array())
    {
        $html = parent::textarea($name, $value, $options);

        $this->wrapDescription($html, $options);

        return $this->wrapRow($options['label'], $html);
    }

    public function submit($value = null, $options = array())
    {
        if (isset($options['class'])) {
            $options['class'] .= ' button button-primary';
        } else {
            $options['class'] = 'button button-primary';
        }

        return parent::submit($value, $options);
    }

    public function input_all($title, $section_fields, $values)
    {
        $input = array();

        foreach ($section_fields as $id => $fields) {
            foreach ($fields as $field) {
                $input[$field['name']] = get_option(sprintf('%s.%s', $title, $field['name']), '');

                if (isset($values[$field['name']])) {
                    $input[$field['name']] = $values[$field['name']];
                }
            }
        }

        return $input;
    }

    private function wrapDescription(&$html, $options)
    {
        if (isset($options['description']) && $options['description']) {
            $html .= sprintf('<p class="description">%s</p>', $options['description']);
        }
    }

    /**
     * Get stored option values.
     *
     * @param string $slug   Slug for storing strings
     * @param array  $fields array of fields
     *
     * @return array
     */
    public function getValues($slug, $sectionFields)
    {
        $input = array();
        foreach ($sectionFields as $fields) {
            foreach ($fields as $field) {
                $input[$field['name']] = get_option(sprintf("%s.%s", $slug, $field['name']), '');
            }
        }

        return $input;
    }

    public function save($input, $slug, $sectionFields)
    {
        foreach ($sectionFields as $fields) {
            foreach ($fields as $field) {
                $value                 = isset($input[$field['name']]) ? $input[$field['name']] : '';

                if(!isset($input[$field['name']])){
                    $input[$field['name']] = $value;
                }

                update_option(sprintf("%s.%s", $slug, $field['name']), $input[$field['name']]);
            }
        }


        return $input;
    }
}
