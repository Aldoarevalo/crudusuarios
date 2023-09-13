var getMonthName = function(number) {
    var month = [];
    month[0] = "ENE";
    month[1] = "FEB";
    month[2] = "MAR";
    month[3] = "ABR";
    month[4] = "MAY";
    month[5] = "JUN";
    month[6] = "JUL";
    month[7] = "AGO";
    month[8] = "SEP";
    month[9] = "OCT";
    month[10] = "NOV";
    month[11] = "DIC";

	return month[number];
};

var getDate = function(date) {
	var currentDate = new Date(date);
	var dd          = currentDate.getDate();
	var mm          = currentDate.getMonth() + 1;
	var yyyy        = currentDate.getFullYear();

	if (dd < 10) {
		dd = '0' + dd;
	}

	if (mm < 10) {
		mm = '0' + mm;
    }
    
	currentDate = yyyy+'-'+mm+'-'+dd;

	return currentDate;
};

var handleScheduleCalendar = function(codIndex) {
	var codOper		= document.getElementById('operacion_'+codIndex).className;
	var monthNames	= ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",  "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	var dayNames	= ["D", "L", "M", "X", "J", "V", "S"];
	var xJSON		= getOpeDetalle(codOper);
	var xDATA 		= [];

	xJSON.forEach(element => {
		var eJSON	= '';
		var eDAY	= parseInt(element.operacion_cuota_vencimiento_2.substr(0, 2));
		var eMONTH	= parseInt(element.operacion_cuota_vencimiento_2.substr(3, 2));
		var eYEAR	= element.operacion_cuota_vencimiento_2.substr(6, 4);

		eJSON = [
			eDAY+'/'+eMONTH+'/'+eYEAR,
			'Vencimiento de cuota ' + element.operacion_cuota_numero,
			'#',
			'#6820c6',
			''
		];
		
		xDATA.push(eJSON);
	});
	
	var events			= xDATA;
	var calendarTarget	= $('#schedule-calendar_'+codIndex);
    
    $(calendarTarget).calendar({
		months: monthNames,
		days: dayNames,
		events: events,
		popover_options:{
			placement: 'top',
			html: true
		}
    });
    
	$(calendarTarget).find('td.event').each(function() {
		var backgroundColor = $(this).css('background-color');
		$(this).removeAttr('style');
		$(this).find('a').css('background-color', backgroundColor);
	});
    
    $(calendarTarget).find('.icon-arrow-left, .icon-arrow-right').parent().on('click', function() {
		$(calendarTarget).find('td.event').each(function() {
			var backgroundColor = $(this).css('background-color');
			$(this).removeAttr('style');
			$(this).find('a').css('background-color', backgroundColor);
		});
	});
};

var DashboardV2 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			for (let index = 1; index <= cantRows; index++) {
				handleScheduleCalendar(index);
			}
		}
	};
}();

$(document).ready(function() {
	DashboardV2.init();
});