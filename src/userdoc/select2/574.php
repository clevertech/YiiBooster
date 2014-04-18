<?php // Issue #574: multiselect inside form should send all selected elements
echo CHtml::beginForm('/', 'post', ['id' => 'issue-574-checker-form']);
$this->widget(
    'bootstrap.widgets.TbSelect2',
    array(
        'name' => 'group_id_list',
        'data' => array('RU' => 'Russian Federation', 'CA' => 'Canada', 'US' => 'United States of America', 'GB' => 'Great Britain'),
        'htmlOptions' => array(
            'multiple' => 'multiple',
        ),
    )
);
echo CHtml::endForm();
$this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'label' => 'Click on me with Developer Tools opened!',
        'htmlOptions' => array(
            'onclick' => 'js:$.ajax({
                url: "/",
                type: "POST",
                data: $("#issue-574-checker-form").serialize()
            });'
        )
    )
);
