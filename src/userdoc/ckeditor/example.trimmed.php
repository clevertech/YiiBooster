<?php // Basic usage of TbCKEditor widget
$this->widget(
    'booster.widgets.TbCKEditor',
    array(
        'name' => 'some_random_text_field',
        'editorOptions' => array(
            // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
            'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
        )
    )
);
