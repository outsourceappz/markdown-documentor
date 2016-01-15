<?php


echo $this->form->wrap();
echo $this->form->title($title);
echo $this->form->open();

foreach ($sections as  $section) {
    echo $this->form->section($section['title'], $section['description']);

    echo $this->form->openTable();

    foreach ($fields[$section['id']] as $field) {
        switch ($field['type']) {
                case 'text':
                    echo $this->form->text($field['name'], $input[$field['name']], ['label' => $field['label'], 'description' => $field['description']]);
                    # code...
                    break;

                case 'textarea':
                    echo $this->form->textarea($field['name'], $input[$field['name']], ['label' => $field['label'], 'description' => $field['description']]);
                    break;

                case 'select':
                    echo $this->form->select($field['name'], $field['options'], $input[$field['name']], ['label' => $field['label'], 'description' => $field['description']]);

                    break;

                case 'checkbox':
                    echo $this->form->checkbox($field['name'], $field['options'], $input[$field['name']], ['label' => $field['label'], 'description' => $field['description']]);
                    break;

                case 'radio':
                    echo $this->form->radio($field['name'], $field['options'], $input[$field['name']], ['label' => $field['label'], 'description' => $field['description']]);
                    break;

                default:
                    # code...
                    break;

            }
    }
    echo $this->form->closeTable();
}

echo $this->form->submit('Save');
echo $this->form->close();
echo $this->form->closeWrap();
