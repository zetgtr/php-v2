<?php

CONST PHOTO_BIG = 'data/big';

require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');

  $twig = new Twig_Environment($loader);

  $template = $twig->loadTemplate('photo.tmpl');
  
  $photo = stripcslashes($_GET['photo']);
  if (!file_exists(PHOTO_BIG . '/' .$photo)) throw new Exception ('Фото отсутсвует');

  echo $template->render(array(
            'title' => 'Список фотографий альбома',
            'dir' => PHOTO_BIG,
            'big' => $photo
            ));
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
