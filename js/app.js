function filter_table(table_t) {
    $.each($('.input-flt', table_t.table().header()), function () {
        var ind = table_t.column.index('fromVisible', $(this).index());
        var column = table_t.column(ind);
        $('input', this).on('keyup change', function () {
            if (column.search() !== this.value) {
                column.search(this.value).draw();
            }
        });
    });

    $.each($('.select-flt', table_t.table().header()), function () {
        var ind = table_t.column.index('fromVisible', $(this).index());
        var column = table_t.column(ind);
        var select = $('select', this);
        select.on('change', function () {
            if (column.search() !== this.value) {
                if ((this.value === "Все") || (this.value === '')) {
                    column.search("").draw();
                } else {
                    column.search(this.value).draw();
                }
            }
        });
    });

}

function getStatuses(field_id) {
    $.ajax({
        type: "POST",
        url: `class/Task.Class.php?user_id=${$('#user_id').val()}&get_statuses=1`,
        async: true,
        success: function (answ) {
            let parsed = JSON.parse(answ);
            let new_options = '<option value="">Все</option>';

            $.each(parsed, function (key, value) {
                new_options += '<option value="' + value.status_name + '">' + value.status_name + '</option>';
            });
            $('#' + field_id).html(new_options);

        }
    });
}