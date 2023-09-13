/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 4.6.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin/admin/
*/

var handleDataTableScroller = function() {
	"use strict";
    
	if ($('.table-operacion').length !== 0) {
		$('.table-operacion').DataTable({
			deferRender:    true,
			scrollY:        370,
			scrollCollapse: true,
			scroller:       true,
			responsive: 	true,
			searching: 		false,
			lengthChange: 	false,
			info: 			false,
			paging: 		true,
			language	: {
				lengthMenu: "Mostrar _MENU_ registros por pagina",
				zeroRecords: "Nothing found - sorry",
				info: "Mostrando pagina _PAGE_ de _PAGES_",
				infoEmpty: "No hay registros disponibles.",
				infoFiltered: "(Filtrado de _MAX_ registros totales)",
				sZeroRecords: "No se encontraron resultados",
				sSearch: "buscar",
				oPaginate: {
					sFirst:    "Primero",
					sLast:     "Último",
					sNext:     "Siguiente",
					sPrevious: "Anterior"
				},
			},
		});
	}
};

var TableManageScroller = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableScroller();
		}
	};
}();

$(document).ready(function() {
	TableManageScroller.init();
});