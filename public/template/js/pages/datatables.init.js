$(document).ready(function () {
    $("#datatable").DataTable({
        "aaSorting": [],
        "sScrollX": "100%",
        "bScrollCollapse": true
    });
        // $("#datatable-buttons")
        //     .DataTable({
        //         lengthChange: !1,
        //         buttons: ["copy", "excel", "pdf", "colvis"],
        //     })
        //     .buttons()
        //     .container()
        //     .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
        // $(".dataTables_length select").addClass("form-select form-select-sm");
});
