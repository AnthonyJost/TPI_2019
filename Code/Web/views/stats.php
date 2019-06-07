<?php foreach($stats as $statName => $statData):?>
<div class="statContainer">
    <?=$statName?>
    <canvas id="<?=$statName?>Chart"></canvas>
    <script>
        var data<?=$statName?> = <?=json_encode($statData);?>;
        var myChart = new Chart(document.getElementById('<?=$statName?>Chart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: Object.keys(data<?=$statName?>),
                datasets: [{
                    data: Object.values(data<?=$statName?>),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                }]
            },
            options: {

            }
        });
    </script>
</div>
<?php endforeach;?>