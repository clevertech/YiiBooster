<?php // Example from the official demo of HighCharts: http://www.highcharts.com/demo/
$this->widget(
    'bootstrap.widgets.TbHighCharts',
    array(
        'options' => array(
            'title' => array(
                'text' => 'Monthly Average Temperature',
                'x' => -20 //center
            ),
            'subtitle' => array(
                'text' => 'Source: WorldClimate.com',
                'x' -20
            ),
            'xAxis' => array(
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            ),
            'yAxis' => array(
                'title' => array(
                    'text' =>  'Temperature (°C)',
                ),
                'plotLines' => [
                    [
                        'value' => 0,
                        'width' => 1,
                        'color' => '#808080'
                    ]
                ],
            ),
            'tooltip' => array(
                'valueSuffix' => '°C'
            ),
            'legend' => array(
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle',
                'borderWidth' => 0
            ),
            'series' => array(
                [
                    'name' => 'Tokyo',
                    'data' => [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                ],
                [
                    'name' => 'New York',
                    'data' => [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
                ],
                [
                    'name' => 'Berlin',
                    'data' => [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
                ],
                [
                    'name' => 'London',
                    'data' => [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                ]
            )
        ),
        'htmlOptions' => array(
            'style' => 'min-width: 310px; height: 400px; margin: 0 auto'
        )
    )
);
