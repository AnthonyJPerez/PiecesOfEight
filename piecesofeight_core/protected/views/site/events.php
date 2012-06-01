<?php 

	$this->pageTitle = "Event Schedule | " . $this->pageTitle;
	$this->pageDescription = "Attending the Portland pirate festival? Going to your favorite Oregon renaissance faire? Look for us at these upcoming renaissance faires and festivals on our list of events.";
	
	$this->pageKeywords = "oregon pirate festivals, oregon renaissance faires, pacific northwest renaissance festivals, list of oregon pirate faires";
	
	
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
							start: new Date(2012, 6, 14),
							end: new Date(2012, 6, 15),
							allDay: true,
							url: 'http://www.canterburyfaire.com'
						},
						{
							title: 'Canterbury Renaissance Faire',
							start: new Date(2012, 6, 21),
							end: new Date(2012, 6, 22),
							allDay: true,
							url: 'http://www.canterburyfaire.com'
						},
						{
							title: 'Faire In The Grove',
							start: new Date(2012, 4, 5),
							end: new Date(2012, 4, 6),
							allDay: true,
							url: 'http://www.faireinthegrove.com/'
						},
						{
							title: 'Greenwood at Glastonbury Renaissance Faire',
							start: new Date(2012, 4, 12),
							end: new Date(2012, 4, 12),
							allDay: true,
							url: 'http://www.yemerriegreenwoodfaire.org/'
						},
						{
							title: 'Rockaway Beach Pirate Festival',
							start: new Date(2012, 5, 22),
							end: new Date(2012, 5, 24),
							allDay: true,
							url: 'http://www.rockawaybeach.net/pirate-festival.htm'
						},
						{
							title: 'Portland Pirate Festival',
							start: new Date(2012, 8, 1),
							end: new Date(2012, 8, 2),
							allDay: true,
							url: 'http://portlandpiratefestival.com/'
						},
						{
							title: 'Shrewsbury Renaissance Faire',
							start: new Date(2012, 8, 8),
							end: new Date(2012, 8, 9),
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

<h1>Our Schedule of Events</h1>
<div id="calendar"></div>









		
	
	
	
	