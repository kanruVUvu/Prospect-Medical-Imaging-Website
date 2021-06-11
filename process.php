<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['referral'])) {
        $errors = [];
        $path = 'uploads/';
	$extensions = ['jpg', 'jpeg', 'png', 'pdf'];
		
        $all_files = count($_FILES['referral']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {  
		$file_name = $_FILES['referral']['name'][$i];
		$file_tmp = $_FILES['referral']['tmp_name'][$i];
		$file_type = $_FILES['referral']['type'][$i];
		$file_size = $_FILES['referral']['size'][$i];
		$tmp = explode('.', $_FILES['referral']['name'][$i]);
		$file_ext = strtolower(end($tmp));

		$file = $path . $file_name;

		if (!in_array($file_ext, $extensions)) {
			$errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
		}

		if ($file_size > 2097152) {
			$errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
		}

		if (empty($errors)) {
			move_uploaded_file($file_tmp, $file);
		}
	}

	if ($errors) print_r($errors);
    }
}
