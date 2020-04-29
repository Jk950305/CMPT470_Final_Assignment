<?php
	session_start();
	$isValid = $_SESSION['loggedin'];
	$students = $_SESSION['students'];
	$total = $_SESSION['total'];
?>

<!doctype html>
<html lang="en">
	
<head>
	<title>CMPT 470 A2P1</title>
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

	<meta charset="utf-8" />
	<meta name="keywords" content="math, Euler, pi, geometry" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<script type="text/javascript" src="/myscripts.js"></script>
	
	
</head>

<body>
	<?php 
		include("header.php"); 
		$letters = array("A+","A","A-","B+","B","B-","C+","C","C-","D","F");
		$_SESSION['letters'] = $letters;
	?>
	<div <?php echo ($isValid!=False)?(""):("hidden"); ?>><h3><a href="logout.php" style="color:white; float:right; margin-right:10px;">logout</a></h3></div>
	<br/>
<div class="container" <?php echo ($isValid==False)?(""):("hidden"); ?>>
	<div class="div1">
		<a href="index.php">Please login first</a>
	</div>
</div>
<div class="container" <?php echo ($isValid!=False)?(""):("hidden"); ?> >
	<form class="div2" action="server/applyCutoffs.php" method="POST">
		<div id="slider"></div>
		<br/>
		<br/>
		<div class="slider_9">
			<input type="number" class="sliderValue" data-index="0"  value="100" disabled hidden/>
			
			<label class ="slider_label" for="A+" style="background: #7F00FF; color: #fff;"><strong>A+</strong></label> >= 
			<input type="number" id="A+" name="A+" class="sliderValue" data-index="1" value="95" id="slider9" readonly/> >
			
			<label class ="slider_label" for="A" style="background: #0000FF; color: #fff;"><strong>A</strong></label> >= 
			<input type="number" id="A" name="A" class="sliderValue" data-index="2" value="90" id="slider8" readonly/> >
			
			<label class ="slider_label" for="A-" style="background: #007FFF; color: #fff;"><strong>A-</strong></label> >= 
			<input type="number" id="A-" name="A-" class="sliderValue" data-index="3" value="85" id="slider7" readonly/><br/>
			
			<label class ="slider_label" for="B+" style="background: #00FFFF; color: #000;"><strong>B+</strong></label> >= 
			<input type="number" id="B+" name="B+" class="sliderValue" data-index="4" value="80" id="slider6" readonly/> >
			
			<label class ="slider_label" for="B" style="background: #00FF88; color: #000;"><strong>B</strong></label> >= 
			<input type="number" id="B" name="B" class="sliderValue" data-index="5" value="75" id="slider5" readonly/> >
			
			<label class ="slider_label" for="B-" style="background: green; color: #fff;"><strong>B-</strong></label> >= 
			<input type="number" id="B-" name="B-" class="sliderValue" data-index="6" value="70" id="slider4" readonly/><br/>
			
			<label class ="slider_label" for="C+" style="background: #7FFF00; color: #000;"><strong>C+</strong></label> >= 
			<input type="number" id="C+" name="C+" class="sliderValue" data-index="7" value="65" id="slider3" readonly/> >
			
			<label class ="slider_label" for="C" style="background: #FFFF00; color: #000;"><strong>C</strong></label> >= 
			<input type="number" id="C" name="C" class="sliderValue" data-index="8" value="60" id="slider2" readonly/> >
			
			<label class ="slider_label" for="C-" style="background: #FF7F00; color: #fff;"><strong>C-</strong></label> >= 
			<input type="number" id="C-" name="C-" class="sliderValue" data-index="9" value="55" id="slider1" readonly/><br/>
			
			<label class ="slider_label" for="D" style="background: #FF0000; color: #fff;"><strong>D</strong></label> >= 
			<input type="number" id="D" name="D" class="sliderValue" data-index="10" value="50" id="slider0" readonly/> >
			
			<label class ="slider_label" for="F" style="background: #FF007F; color: #fff;"><strong>F</strong></label> >= 
			<input type="number" class="sliderValue" data-index="11" value="0" disabled/><br/>

			<input type="hidden" id="MAX" name="MAX" value="100"/>
			<input type="hidden" id="MIN" name="MIN" value="0"/>
		</div>
		<br/>
		<input type="submit" value="Submit">
	</form>
</div>

	
</body>
<script>
   	jQuery(document).ready(function($) {
   		widget_slider();
   		function widget_slider() {
	    	slider_values = [100, 96, 90, 85, 80, 75, 70, 65, 60, 55, 50, 0];

			var setSlider = function ( values ) {
				jQuery("#slider").slider({
					values: values,
					min: 0,
					max: 100,
					step: 1,
					create: function (evt, ui) {
				        $(this).addClass("ui-slider-multiple");
				    },
				    slide: function(evt, ui) {
				        for(var i = 0, l = (ui.values.length); i <= l; i++){
				        	var prev = (i==0)?100:$(".slider_9 .sliderValue[data-index=" + (i+1) + "]").val();
				        	var next = (i==11)?0:$(".slider_9 .sliderValue[data-index=" + (i-1) + "]").val();
				        	if(ui.values[i]>prev && ui.values[i]<next && i!=0){
				        		$(".slider_9 .sliderValue[data-index=" + i + "]").val(ui.values[i]);
				        	}

				        	if((i==0&&ui.values[i]!=100)||(i==11&&ui.values[i]!=0)){
				        		return false;
				        	}

				        	if(i !== l-1 && ui.values[i] >= ui.values[i - 1]){
				              return false;
				            }else if(i === 0 && ui.values[i] <= ui.values[i + 1]){
				              return false;
				            }
				        }
				    }
				}).each(function() {
				    var opt = $(this).data().uiSlider.options;

				    var vals = opt.max - opt.min;

				    for (var i = 0; i <= vals; i+=5) {
				        var el = $('<label>' + (i + opt.min) + '</label>').css('left', (i/vals*100) + '%');
				        $("#slider").append(el);

				    }

				});
			};
			var val = slider_values;
			setSlider( val );
		}
	});
</script>
</html> 
