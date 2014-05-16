<?php // Basic usage of TbRedactorJs widget
$this->widget(
    'booster.widgets.TbRedactorJs',
    [
        'name' => 'another_text',
        'value' => 'Hover over the toolbar buttons to see whether it is really in Korean!',
        'editorOptions' => [
            'lang' => 'ko',
            'plugins' => ['fontfamily', 'textdirection']
        ],
    ]
);
