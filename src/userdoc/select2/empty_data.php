<?php // Initially empty TbSelect2 (data is null)
$this->widget(
    'bootstrap.widgets.TbSelect2',
    array(
        'name' => 'emptydata',
        'data' => null,
        'options' => array(
            'placeholder' => 'type clever, or is, or just type!',
            'width' => '40%',
        )
    )
);

