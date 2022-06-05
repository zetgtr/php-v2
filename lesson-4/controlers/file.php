<?php 
include '../function.php';
include '../config.php';
$file = @$_FILES['file'];
$id = $_GET["id"];
$num = $_GET["num"];
$delPhoto = $_GET['photo'];
$error = $success = '';

// Разрешенные расширения файлов.
$allow = array('jpg', 'jpeg', 'png', 'gif');
 
// Директория, куда будут загружаться файлы.
$path = $_SERVER["DOCUMENT_ROOT"] . '/img/';
 
if (!empty($file)) {
	// Проверим на ошибки загрузки.
	if (!empty($file['error']) || empty($file['tmp_name'])) {
		switch (@$file['error']) {
			case 1:
			case 2: $error = 'Превышен размер загружаемого файла.'; break;
			case 3: $error = 'Файл был получен только частично.'; break;
			case 4: $error = 'Файл не был загружен.'; break;
			case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
			case 7: $error = 'Не удалось записать файл на диск.'; break;
			case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
			case 9: $error = 'Файл не был загружен - директория не существует.'; break;
			case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
			case 11: $error = 'Данный тип файла запрещен.'; break;
			case 12: $error = 'Ошибка при копировании файла.'; break;
			default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
		}
	} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
		$error = 'Не удалось загрузить файл.';
	} else {
		// Оставляем в имени файла только буквы, цифры и некоторые символы.
		$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
		$name = mb_eregi_replace($pattern, '-', $file['name']);
		$name = mb_ereg_replace('[-]+', '-', $name);
 
		$parts = pathinfo($name);
		if (empty($name) || empty($parts['extension'])) {
			$error = 'Не удалось загрузить файл.';
		} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
			$error = 'Недопустимый тип файла';
		} else {
			// Перемещаем файл в директорию.
			if (move_uploaded_file($file['tmp_name'], $path . $name)) {
				if($name!==$delPhoto){
					unlink($path.$delPhoto);
				}
				editPhoto($connect, $id, $num, $name);
				$success = 'Файл «' . $name . '» успешно загружен.';
			} else {
				$error = 'Не удалось загрузить файл.';
			}
		}
	}
 
	// Выводим сообщение о результате загрузки.
	if (!empty($success)) {?>
		<img 
            class="modal_photo-1" 
            src="/img/<?=$name?>" 
            alt="<?=$name?>">
	<?} else {
		echo '<span class="error">' . $error . '</span>';
	}
}