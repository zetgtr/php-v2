<?php

CONST PHOTO_SMALL = 'data/small';

require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');

  $twig = new Twig_Environment($loader);

  $template = $twig->loadTemplate('index.tmpl');

  $photos_dir = array_slice(scandir(PHOTO_SMALL), 2);

  echo $template->render([
            'title' => 'Фото',
            'dir' => PHOTO_SMALL,
            'small' => $photos_dir
            ]);
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
