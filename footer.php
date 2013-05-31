<!-- footer.php -->

<div class="navbar navbar-fixed-bottom footer">
    <footer>
    	<p>&copy; Projet NF17&nbsp&nbsp&nbsp&nbsp
    	Groupe: Hugo Trotignon, Maxime Daragon, Pierre Lemaire, Siqi Liu</p>
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

</body>
</html>