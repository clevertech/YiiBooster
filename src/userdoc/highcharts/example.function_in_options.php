<?php // You can pass functions as options to HighChart
$this->widget(
    'bootstrap.widgets.TbHighCharts',
    array(
        'options' => array(
            'tooltip' => array(
                'formatter' => new CJavaScriptExpression("
                    function() {
                        return Highcharts.numberFormat(this.y, 0) + ' by ' + this.series.name +'<br/>'+' in '+ this.x;
                    }"),
            ),
            'series' => array(
                [
                    'data' => [1, 2, 3, 4]
                ]
            )
        )
    )
);
