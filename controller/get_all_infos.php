<?php
require_once './../db_manage/db_manage.php';

// Get all infos 
$query = new MyDataBase();
$query->get_all_infos();