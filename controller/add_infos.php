<?php
require_once './../db_manage/db_manage.php';

// Call add_infos function in db_manage
$query = new MyDataBase();
$query->add_infos($_POST['name'], $_POST['comment']);