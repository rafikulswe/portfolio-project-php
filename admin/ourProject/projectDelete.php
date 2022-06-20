<?php
    require '../controller/dbConfig.php';

    $banner_id = $_GET['banner_id'];
    $updateQry = "UPDATE banners SET active_status=0 WHERE id='{$banner_id}'";

    $isSubmit = mysqli_query($dbCon, $updateQry);

    if ($isSubmit == true) {
        $message = "Banner Deleted Succesfull";
    } else {
        $message = "Deleted Failed";
    }

    header("Location: ../banner/bannerList.php?msg={$message}");
