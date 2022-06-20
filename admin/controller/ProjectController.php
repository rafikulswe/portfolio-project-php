<?php
    require 'dbConfig.php';
    // THIS FOR CREATE
    if (isset($_POST['saveProject'])) {

        $upload_status = false;
        if (isset($_FILES['project_thumb'])) {
            $imgArray = $_FILES['project_thumb'];

            $file_name = $imgArray['name'];
            $tmp_file_name = $imgArray['tmp_name'];

            $nameExtArr = explode('.', $file_name);
            $file_extension = strtolower(end($nameExtArr));
            $valid_extensions = array('jpg', 'png', 'jpeg');

            $random_file_name = time().'.'.$file_extension;

            if (in_array($file_extension, $valid_extensions)) {
                move_uploaded_file($tmp_file_name, '../uploads/projectThumb/'.$random_file_name);
                $upload_status = true;
            } else {
                $message = $file_extension." is not Supported";
            }
        } else {
            $message = "File Not Found";
        }
        
        $category_id   = $_POST['category_id'];
        $project_name  = $_POST['project_name'];
        $project_link  = $_POST['project_link'];

        if (empty($category_id) || empty($project_name) || empty($project_link) || $upload_status == false) {
            $message = "All fields are required";
        } else {
            $insertQry = "INSERT INTO our_projects (category_id, project_name, project_link, project_thumb) VALUES ('{$category_id}', '{$project_name}', '{$project_link}', '{$random_file_name}')";
            $isSubmit = mysqli_query($dbCon, $insertQry);

            if ($isSubmit == true) {
                $message = "Project Insert Succesfull";
            } else {
                $message = "Insert Failed";
            }
        }

        header("Location: ../ourProject/projectCreate.php?msg={$message}");
        
    }

    // THIS FOR UPDATE
    if (isset($_POST['updateProject'])) {

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
                $message = "Project Update Succesfull";
            } else {
                $message = "Update Failed";
            }
        }

        header("Location: ../banner/bannerUpdate.php?banner_id={$banner_id}&msg={$message}");
        
    }