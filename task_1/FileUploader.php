<?php

class FileUploader
{
    const TARGET_DIR = 'files/';

    /**
     * @return void
     */
    public function uploadFile()
    {
        if (isset($_POST['submit'])) {
            $target_file = self::TARGET_DIR . basename($_FILES['file']['name']);
            $uploadOk = true;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            $uploadOk = $this->checkFileType($fileType, $uploadOk);
            $uploadOk = $this->checkExistingFile($target_file, $uploadOk);
            $uploadOk = $this->checkFileSize($uploadOk);

            if ($uploadOk && move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                $this->loadingCircle(true);
                $this->processFile($target_file);
            } else {
                $this->loadingCircle(false);
            }
        }
    }

    /**
     * @param $fileType
     * @param $uploadOk
     * @return bool
     */
    private function checkFileType($fileType, $uploadOk): bool
    {
        if ($fileType !== 'txt') {
            echo '<div class="result fail">
            <h2>Ошибка загрузки</h2>
            <p>Допустимый формат файла: .txt</p>
        </div>';
            return false;
        }
        return $uploadOk;
    }

    /**
     * @param $target_file
     * @param $uploadOk
     * @return bool
     */
    private function checkExistingFile($target_file, $uploadOk): bool
    {
        if (file_exists($target_file)) {
            echo '<div class="result fail">
            <h2>Ошибка загрузки</h2>
            <p>Файл с таким именем уже существует</p>
        </div>';
            return false;
        }
        return $uploadOk;
    }

    /**
     * @param $uploadOk
     * @return bool
     */
    private function checkFileSize($uploadOk): bool
    {
        if ($_FILES['file']['size'] > 500000) {
            echo '<div class="result fail">
            <h2>Ошибка загрузки</h2>
            <p>Превышен максимальный размер файла (500 КБ)</p>
        </div>';
            return false;
        }
        return $uploadOk;
    }

    /**
     * @param $target_file
     * @return void
     */
    private function processFile($target_file)
    {
        $fileContent = file_get_contents($target_file);
        $lines = explode(PHP_EOL, $fileContent);
        foreach ($lines as $line) {
            preg_match_all('/\d/', $line, $matches);
            echo $line . ' = ' . count($matches[0]) . '<br>';
        }
    }

    private function loadingCircle($isSuccess)
    {
        if ($isSuccess) {
            echo '<div class="circle success"></div>';
        } else {
            echo '<div class="circle fail"></div>';
        }
    }

}