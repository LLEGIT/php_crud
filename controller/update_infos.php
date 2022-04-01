<?php
require_once './../db_manage/db_manage.php';

// Call the update function
$update = new MyDataBase();
$update->update_infos($_POST['id'], $_POST['name'], $_POST['comment']);