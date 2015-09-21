<!DOCTYPE HTML>
<html lang='en-US'>
<head>
	<title>My Calendar</title>
	<meta charset='UTF-8'>

	<style type='text/css'>
	.calendar{

		font-family: Arial;
		font-size: 12px;

	}
	table.calendar{
		margin: auto;
		border-collapse: collapse;
	}
	.calendar .days td {
		width: 90px; height: 90px; padding: 4px;
		border: 1px solid #999;
		vertical-align: top;
		background-color: #DEF;
	}

	.calendar .days td:hover{
		background-color: #FFF;
	}
	.calendar .highlight{
		font-weight: bold; color:#00F;
	}
	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min .js"></script>
	-->
</head>
<body>
	<?php echo $calendar; ?>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.calendar .day').click(function() {
			day_num = $(this).find('.day_num').html();
			//alert(day_num);
			day_data = prompt('Enter Stuff', $(this).find('.content').html());
			if (day_data != null){

				$.ajax({
					url: 'http://localhost/rent_n_roam/trunk/rentnroam/host/display',
					type: 'POST',
					data: {
						day: day_num,
						data: day_data
					},
					success: function(msg){
						location.reload();
					}
				});
			}
		});
	});
	</script>
</body>
</html>	