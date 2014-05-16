<?php // Basic usage of TbRedactorJs widget
$this->widget(
    'booster.widgets.TbRedactorJs',
    [
        'name' => 'some_name',
        'value' => '<b>Here is the text which will be put into editor view upon opening.</b>',
    ]
);
