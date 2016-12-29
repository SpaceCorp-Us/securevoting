<?php

echo '<title>'.$this->config->item('siteName').'</title>';
echo '<meta charset="utf-8">';
echo '<link rel="icon shortcut" type="image/png" href="'.$basePath.'css/'.$theme.'/icon.png">';
echo '<script type="text/javascript" src="'.$basePath.'js/jquery-latest.js"></script>';

echo '<link rel="stylesheet" type="text/css" href="'.$basePath.'css/'.$theme.'/layout.css"/>';

echo '<link rel="stylesheet" type="text/css" href="'.$basePath.'css/'.$theme.'.css"/>';

echo '<style type="text/css">';
echo '#backdrop { background-image:url('.$basePath.$this->shared_model->selectBackdrop($theme).'); }';
echo '</style>';

// EoF !
