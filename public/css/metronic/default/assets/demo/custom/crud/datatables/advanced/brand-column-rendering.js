var DatatablesAdvancedColumnRendering = function() {

	var initTable1 = function() {
		var table = $('#m_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
			paging: true,
			columnDefs: [
				{
					targets: 0,
					render: function(data, type, full, meta) {
						var number = mUtil.getRandomInt(1, 14);
						var user_img = '100_' + number + '.jpg';

						var output;
                        output = `
                            <div class="m-card-user m-card-user--sm">
                                <div class="m-card-user__pic">
                                    <img src="${data}" class="m--img-rounded m--marginless" alt="photo">
                                </div>
                            </div>`;
						
						return output;
					},
				},
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <a href="${data}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
				},
			],
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	DatatablesAdvancedColumnRendering.init();
});