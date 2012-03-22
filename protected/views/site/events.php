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
					/*events: '".$this->createUrl('site/eventsFeed')."',*/
					
					events:
					[
						{
							title: 'Canterbury Renaissance Faire',
							start: new Date(2012, 7, 14),
							end: new Date(2012, 7, 15),
							allDay: true,
							url: 'http://www.canterburyfaire.com'
						},
						{
							title: 'Canterbury Renaissance Faire',
							start: new Date(2012, 7, 21),
							end: new Date(2012, 7, 22),
							allDay: true,
							url: 'http://www.canterburyfaire.com'
						},
						{
							title: 'Faire In The Grove',
							start: new Date(2012, 5, 5),
							end: new Date(2012, 5, 6),
							allDay: true,
							url: 'http://www.faireinthegrove.com/'
						},
						{
							title: 'Greenwood at Glastonbury Renaissance Faire',
							start: new Date(2012, 5, 12),
							end: new Date(2012, 5, 12),
							allDay: true,
							url: 'http://www.yemerriegreenwoodfaire.org/'
						},
						{
							title: 'Rockaway Beach Pirate Festival',
							start: new Date(2012, 06, 22),
							end: new Date(2012, 06, 24),
							allDay: true,
							url: 'http://www.rockawaybeach.net/pirate-festival.htm'
						},
						{
							title: 'Portland Pirate Festival',
							start: new Date(2012, 9, 1),
							end: new Date(2012, 9, 2),
							allDay: true,
							url: 'http://portlandpiratefestival.com/'
						},
						{
							title: 'Shrewsbury Renaissance Faire',
							start: new Date(2012, 9, 8),
							end: new Date(2012, 9, 9),
							allDay: true,
							url: 'http://shrewfaire.com/'
						}						
					]
				});
				
			});
		",
		CClientScript::POS_HEAD
	);
	
?>

<h2>Events</h2>
<div id="calendar"></div>









		
	
	
	
	