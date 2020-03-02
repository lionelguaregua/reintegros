<script>
    // Create the chart
Highcharts.chart('chart2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total aprobado por cobertura'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Monto en USD'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> USD<br/>'
    },

    series: [{
            name: "Coberturas",
            colorByPoint: true,
            data: {!!$dataTwo!!}
        }
    ]
    
});
</script>