<?php
/** @var array $labels */
/** @var array $femaleData */
/** @var array $maleData */
/** @var View $this */

use dosamigos\chartjs\ChartJs;
use yii\web\View;

$this->title = 'Chart of years of passed questionnaires by gender'
?>

<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 100,
        'width' => 400
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => "Female",
                'backgroundColor' => "rgba(204, 255, 0, 0.2)",
                'borderColor' => "rgba(173, 0, 204, 0.3)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $femaleData
            ],
            [
                'label' => "Male",
                'backgroundColor' => "rgba(0, 7, 204, 0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $maleData
            ]
        ]
    ]
]);
?>
<hr>
<?= ChartJs::widget([
    'type' => 'radar',
    'options' => [
        'height' => 400,
        'width' => 400
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => "Female",
                'backgroundColor' => "rgba(204, 255, 0, 0.2)",
                'borderColor' => "rgba(173, 0, 204, 0.3)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $femaleData
            ],
            [
                'label' => "Male",
                'backgroundColor' => "rgba(0, 7, 204, 0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $maleData
            ]
        ]
    ]
]);
?>


