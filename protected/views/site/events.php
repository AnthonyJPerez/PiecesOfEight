<?php 

	$this->pageTitle = "Events - " . Yii::app()->name;
	
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/css/fullcalendar.css', 
		'screen'
	);
	
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	
	Yii::app()->clientScript->registerScriptFile(
		Yii::app()->request->baseUrl . '/js/fullcalendar.min.js', 
		CClientScript::POS_HEAD
	);
	
	// Documentation available at: http://arshaw.com/fullcalendar/docs/
	Yii::app()->clientScript->registerScript(
		'js-calendar',
		"
			$(document).ready(function() 
			{
		
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				
				$('#calendar').fullCalendar(
				{
					header: 
					{
						left: 'prev,next today',
						center: 'title',
						right: 'month,basicWeek,basicDay'
					},
					editable: false,
					events: '".$this->createUrl('site/eventsFeed')."',
				});
				
			});
		",
		CClientScript::POS_HEAD
	);
	
?>

<h2>Events</h2>
<div id="calendar"></div>









		
	
	
	
	