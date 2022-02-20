<?php
/** @var array $labels */
/** @var array $counts */

/** @var View $this */

use dosamigos\chartjs\ChartJs;
use yii\web\View;

$this->title = 'Chart emails hosts';
?>
<div class="mb-5">
    <a class="btn btn-primary" href="/admin/questionnaire/chart-year-by-gender">
        Years of passed questionnaires by gender
    </a>
    <a class="btn btn-dark" href="/admin/questionnaire/chart-email-hosts">
        Emails hosts
    </a>
    <a class="btn btn-secondary"
       href="/admin/questionnaire/chart-by-attribute?ChartByAttributeForm[attribute]=region">
        Chart by attribute
    </a>
</div>
<?= ChartJs::widget([
    'type' => 'polarArea',
    'options' => [
        'height' => 100,
        'width' => 400
    ],
    'data' => [
        'labels' => $labels[0],
        'datasets' => [
            [
                'label' => "Email Hosts",
                'backgroundColor' => [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)'
                ],
                'data' => $counts[0]
            ],
        ]
    ]
]);
?>
    <hr>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 100,
        'width' => 400
    ],
    'data' => [
        'labels' => $labels[1],
        'datasets' => [
            [
                'label' => "Email Hosts",
                'backgroundColor' => "rgba(204, 255, 0, 0.2)",
                'borderColor' => "rgba(173, 0, 204, 0.3)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $counts[1]
            ],
        ]
    ]
]);
?>