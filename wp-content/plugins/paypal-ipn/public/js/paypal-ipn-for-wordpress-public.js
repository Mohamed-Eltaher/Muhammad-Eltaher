(function ($) {
    'use strict';
    $(document).ready(function () {
        $('#example').DataTable({
            "responsive": true,
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "order": [],
            "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false
            }],
            "fnDrawCallback": function () {
                if (this.fnSettings().fnRecordsDisplay() > 10) {
                    $('#example_paginate').css("display", "block");
                } else {
                    $('#example_paginate').css("display", "none");
                }
            }

        });
    });

})(jQuery);
