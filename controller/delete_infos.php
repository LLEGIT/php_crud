<?php
require_once './../db_manage/db_manage.php';

// Call the delete function
$delete = new MyDataBase();
$delete->delete_infos($_POST['id']);