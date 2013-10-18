<?php // Basic usage of TbRedactorJs widget
$this->widget(
    'bootstrap.widgets.TbRedactorJs',
    [
        'name' => 'fancy_text',
        'value' => 'Press Enter in here to test the callback.',
        'editorOptions' => [
            'enterCallback' => new CJavaScriptExpression(
                'function (event) {
                    console.debug(event);
                    $.notify("I see you have pressed Enter...", "warning");
                }'
            )
        ],
    ]
);
