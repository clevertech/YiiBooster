<?php // You can use zero values in data
$this->widget(
    'booster.widgets.TbHighCharts',
    array(
        'options' => array(
            'series' => array(
                array(
                    'data' => array(0, 1.5, 4, 3, 1, 0, -1, -3, -4, -1.5, 0)
                ),
                array(
                    'data' => new CJavaScriptExpression(
                        '[0, -3/2, -2*2, -0.3e1, -Math.pow(354,0), 1-1, 3/3, 3, 4, 4-2.5, 0]'
                    )
                )
            )
        )
    )
);
