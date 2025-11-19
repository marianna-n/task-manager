<?php require_once __DIR__ . '/layouts/header.tpl.php'; ?>
<div class="wrapper">
    <h5>Создать задачу</h5>
    <div class="create-task">
        <form id="create-task-form" method="post" class="mb-2">
            <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>" />
            <div class="form-floating">
                <input type="text" name="title" class="form-control" id="title" placeholder="Заголовок">
                <label for="title">Заголовок</label>
            </div>
            <br>
            <div class="form-floating">
                <textarea name="description" class="form-control" placeholder="Описаниие задачи" id="description"
                    style="height: 100px"></textarea>
                <label for="description">Описание</label>
            </div>

            <button id="create-task" name="create-task" type="submit" class="btn btn-primary mt-3">Create</button><span id=form-message></span>

        </form>
    </div>
    <br>
    <table id="task_table" class="display compact cell-border row-border" data-page-length="10" style="width: 100%;">
        <thead>
            <tr>
                <th id="th_id">№</th>
                <th id="th_create_at">Дата создания</th>
                <th id="th_update_at">Дата последнего изменения</th>
                <th id="th_status_name">Статус</th>
                <th id="th_description">Описание</th>
                <th id="th_answ">Ответ</th>
            </tr>
            <tr class="table-serching-row">
                <td class="input-flt"><input id="filter_id" class="search-input" type="text" name="filter_id" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_create_at" class="search-input" type="text" name="filter_create_at" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_update_at" class="search-input" type="text" name="filter_update_at" autocomplete="off" /></td>
                <td class="select-flt">
                    <select id="filter_status_name" class="search-input" name="filter_status_name" autocomplete="off">

                    </select>
                </td>
                <td class="input-flt"><input id="filter_description" class="search-input" type="text" name="filter_description" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_answ" class="search-input" type="text" name="filter_answ" autocomplete="off" /></td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script src="/../../js/userpage.js?v=<?php echo filemtime('js/userpage.js'); ?>"></script>
<?php require_once __DIR__ . '/layouts/footer.tpl.php'; ?>