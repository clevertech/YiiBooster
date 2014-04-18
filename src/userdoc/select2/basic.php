<?php // Basic usage of Select2 widget
$this->widget(
    'bootstrap.widgets.TbSelect2',
    array(
        'asDropDownList' => false,
        'name' => 'clevertech',
        'options' => array(
            'tags' => array('clever', 'is', 'better', 'clevertech'),
            'placeholder' => 'type clever, or is, or just type!',
            'width' => '40%',
            'tokenSeparators' => array(',', ' ')
        )
    )
);


