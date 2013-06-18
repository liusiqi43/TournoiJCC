<!-- footer.php -->

<div class="navbar navbar-fixed-bottom footer">
    <footer>
    	<p>&copy; Projet NF17&nbsp&nbsp&nbsp&nbsp
    	Groupe: Siqi Liu, Maxime Daragon, Pierre Lemaire, Hugo Trotignon</p>
    </footer>
</div>



</div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $ROOT; ?>assets/js/jquery.js"></script>
    <script src="<?php echo $ROOT; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $ROOT; ?>assets/js/bootstrap-datepicker.js"></script>

    <script>

    $(function(){
        window.prettyPrint && prettyPrint();
        $('#dpMatch').datepicker({
            format: 'dd-mm-yyyy'
        });
    });
    
    </script>


<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
    
<script>
$(function () {
        var title_budget = document.getElementById('title_graphe');
        $('#graph_container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: title_budget.innerHTML
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Répartition des cartes',
                data: data_repartition
            }]
        });
    });
    
</script>
</body>
</html>
