<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual
files as needed -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".calendertd").click(function(){
			var day = $(this).text();
			var month = $(this).attr("month");
			var year = $(this).attr("year");
			var fulldate = year+ "-" + month +"-"+ day;

			window.location.replace('<?php echo base_url('events/create?date=');?>' + fulldate);
		});

		$('input[name=type]').click(function(){
			var selectedvalue = $('input[name=type]:checked').val();
			if(selectedvalue === "repeating")
			{
				$("#repeat").show();
			}
			else
			{
				$("#repeat").hide();
			}
		});

		
	});
</script>

</html>