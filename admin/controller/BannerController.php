<?php
    require 'dbConfig.php';
    // THIS FOR CREATE
    if (isset($_POST['saveBanner'])) {
        $title     = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $details   = $_POST['details'];

        if (empty($title) || empty($sub_title) || empty($details)) {
            $message = "All fields are required";
        } else {
            $insertQry = "INSERT INTO banners (title, sub_title, details) VALUES ('{$title}', '{$sub_title}', '{$details}')";
            $isSubmit = mysqli_query($dbCon, $insertQry);

            if ($isSubmit == true) {
                $message = "Banner Insert Succesfull";
            } else {
                $message = "Insert Failed";
            }
        }

        header("Location: ../banner/bannerCreate.php?msg={$message}");
        
    }

    // THIS FOR UPDATE
    if (isset($_POST['updateBanner'])) {

        $banner_id = $_POST['banner_id'];
        $title     = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $details   = $_POST['details'];

        if (empty($title) || empty($sub_title) || empty($details)) {
            $message = "All fields are required";
        } else {
            $updateQry = "UPDATE banners SET title='{$title}', sub_title='{$sub_title}', details='{$details}' WHERE id='{$banner_id}'";

            $isSubmit = mysqli_query($dbCon, $updateQry);

            if ($isSubmit == true) {
                $message = "Banner Update Succesfull";
            } else {
                $message = "Update Failed";
            }
        }

        header("Location: ../banner/bannerUpdate.php?banner_id={$banner_id}&msg={$message}");
        
    }