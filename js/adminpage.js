$(document).ready(function () {

    if ($('#task_table').length) {
        getStatuses('filter_status_name');
    }


    let task_table = $("#task_table").on("xhr.dt",
        function (e, settings, json, xhr) {
            /*if ((typeof json.code !== "undefined") && (json.code !== 1) && (json.msg !== '')) {
                json.data = [];
                //console.log(json);
                Errorhandler(json);
            }*/
        }).DataTable({
            "ajax": {
                "url": `class/Task.Class.php?user_id=${$('#user_id').val()}&get_task=1`,
                "cache": false,
                "dataType": "json",
                "dataSrc": '',

            },
            "language": 'en',
            "scrollY": true,
            "scrollX": true,
            "scrollCollapse": true,
            "searching": true,
            "lengthChange": true,
            "fixedHeader": true,
            "order": [0, "asc"],
            "rowId": "id",
            "orderCellsTop": true,
            "stateSave": false,
            "sDom": "<'row'<'col - sm - 12'tr>><'footer-dataTable'<'length-block'l><'infoPage-block'i><'paginate-block'p>>",
            "columns": [
                { "data": (row) => { return `<button class="task-about">...</button>`; }, "visible": true, "searchable": true, "sortable": true, "className": "td-id" },
                { "data": "id", "visible": true, "searchable": true, "sortable": true, "className": "td-id" },
                { "data": "created_at", "visible": true, "searchable": true, "sortable": true },
                { "data": "updated_at", "visible": true, "searchable": true, "sortable": true },
                { "data": "status_name", "visible": true, "searchable": true, "sortable": true },
                { "data": "name", "visible": true, "searchable": true, "sortable": true },
                { "data": "description", "visible": true, "searchable": true, "sortable": true },
                { "data": "answ", "visible": true, "searchable": true, "sortable": true },
                { "data": "tags", "visible": true, "searchable": true, "sortable": true },
            ],
            initComplete: function () {
                filter_table(this.api());
            },
            "pagingType": "numbers"
        });

    $('#task_table').on('click', '.task-about', function () {
        let tr = $(this).closest('tr');
        let rowData = task_table.row(tr).data();
        console.log(rowData);
        $('#task_id').val(rowData.id);
        $('#title').html(rowData.title);
        $('#name').html(rowData.name);
        $('#description').html(rowData.description);
        $('#answ').html(rowData.answ);
        $('#tags').html(rowData.tags);
        $('#status_id').val(rowData.status_id);
        $('#task-popup-overlay').css("display", "block");


    });

    $('.close-task-settings').bind('click', function () {
        closeModal();
    });

    $('#save-task').bind('click', function () {
        $.ajax({
            url: `class/Task.Class.php?user_id=${$('#user_id').val()}&save_task=1`,
            data: $("#save-task-form").serializeArray(),
            type: "POST",
            async: false,
            //dataType:'json',
            success: (answ) => {
                let parsed = JSON.parse(answ);

            },
            error: () => {
                console.log('Неизвестная ошибка');
            }
        });
        task_table.ajax.reload(null, false);
        closeModal();
        return false;
    });
});

function closeModal() {
    $('#task_id').val('');
    $('#title').html('');
    $('#name').html('');
    $('#description').html('');
    $('#answ').html('');
    $('#tags').html('');
    $('#status_id').val(1);
    $('#task-popup-overlay').css("display", "none");
}