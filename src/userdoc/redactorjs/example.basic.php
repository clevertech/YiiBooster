<?php // Basic usage of TbRedactorJs widget
$this->widget(
    'bootstrap.widgets.TbRedactorJs',
    [
        'name' => 'some_name',
        'value' => '<b>Here is the text which will be put into editor view upon opening.</b>',
    ]
);
