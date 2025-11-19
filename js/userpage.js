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
                { "data": "id", "visible": true, "searchable": true, "sortable": true, "className": "td-id" },
                { "data": "created_at", "visible": true, "searchable": true, "sortable": true },
                { "data": "updated_at", "visible": true, "searchable": true, "sortable": true },
                { "data": "status_name", "visible": true, "searchable": true, "sortable": true },
                { "data": "description", "visible": true, "searchable": true, "sortable": true },
                { "data": "answ", "visible": true, "searchable": true, "sortable": true },
            ],
            initComplete: function () {
                filter_table(this.api());
            },
            "pagingType": "numbers"
        });

    $('#create-task').bind('click', function () {
        let title = $('#title').val().trim();
        let description = $('#description').val().trim();
        if (title == '' && description == '') {
            $('#form-message').html('Заполните поля');
        } else {
            $('#form-message').html('');
            $.ajax({
                url: `class/Task.Class.php?user_id=${$('#user_id').val()}&create_task=1`,
                data: $("#create-task-form").serializeArray(),
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
            title.val('');
            description.val('');

        }

        return false;
    });
});