<?php require_once __DIR__ . '/layouts/header.tpl.php'; ?>
<div class="wrapper">
    <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>" />
    <!-- <h5>Просмотреть задачу</h5>
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

            <button id="create-task" name="create-task" type="submit" class="btn btn-primary mt-3">Create</button>

        </form>
    </div> -->
    <br>
    <table id="task_table" class="display compact cell-border row-border" data-page-length="10" style="width: 100%;">
        <thead>
            <tr>
                <th id="th_btn"></th>
                <th id="th_id">№</th>
                <th id="th_create_at">Дата создания</th>
                <th id="th_update_at">Дата последнего изменения</th>
                <th id="th_status_name">Статус</th>
                <th id="th_name">Имя</th>
                <th id="th_description">Описание</th>
                <th id="th_answ">Ответ</th>
                <th id="th_tags">Теги</th>
            </tr>
            <tr class="table-serching-row">
                <td></td>
                <td class="input-flt"><input id="filter_id" class="search-input" type="text" name="filter_id" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_create_at" class="search-input" type="text" name="filter_create_at" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_update_at" class="search-input" type="text" name="filter_update_at" autocomplete="off" /></td>
                <td class="select-flt">
                    <select id="filter_status_name" class="search-input" name="filter_status_name" autocomplete="off">

                    </select>
                </td>
                <td class="input-flt"><input id="filter_name" class="search-input" type="text" name="filter_name" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_description" class="search-input" type="text" name="filter_description" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_answ" class="search-input" type="text" name="filter_answ" autocomplete="off" /></td>
                <td class="input-flt"><input id="filter_tags" class="search-input" type="text" name="filter_tags" autocomplete="off" /></td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div id="task-popup-overlay">
    <div class="task-modal-block">
        <h3><span class="flex-1">Задача</span><span class="close-task-settings">Х</span></h3>
        <form id="save-task-form" method="post">
            <input id="task_id" type="hidden" name="id" value="" />
            <div class="">
                <label for="title">Заголовок</label>
                <p id="title"></p>

            </div>

            <div class="">
                <label for="name">Имя пользователя</label>
                <p id="name"></p>

            </div>

            <div class="">
                <label for="description">Описание</label>
                <p id="description"></p>

            </div>

            <div class="">
                <label for="description">Статус</label>
                <select id="status_id" class="content-select" name="status_id">
                    <?php foreach ($data['statuses'] as $key => $value) { ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['status_name'] ?></option>
                    <?php } ?>
                </select>

            </div>
            <br>
            <div class="">
                <label for="description">Ответ</label>
                <textarea name="answ" class="form-control" id="answ"
                    style="height: 100px"></textarea>

            </div>
            <br>
            <div class="">
                <label for="description">Тэги</label>
                <textarea name="tags" class="form-control" id="tags"
                    style="height: 100px"></textarea>

            </div>
            <br>
            <button id="save-task" name="save-task" type="submit" class="btn btn-primary mt-3">Сохранить</button>

        </form>


    </div>
</div>
<script src="/../../js/adminpage.js?v=<?php echo filemtime('js/adminpage.js'); ?>"></script>
<?php require_once __DIR__ . '/layouts/footer.tpl.php'; ?>