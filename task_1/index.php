<?php
require_once './FileUploader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="upload">
    <h1>Загрузка файла</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <br><br>
        <input type="submit" name="submit" value="Загрузить">
    </form>
</div>

<?php
$fileUploader = new FileUploader();
$fileUploader->uploadFile();
?>
</body>
</html>