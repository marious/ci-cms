<?php

// var_dump($files);

// exit;


function display_files($files) {
    $output = '<ul class="files">';
    foreach ($files as $key => $file) {
        if (is_array($file) == false) {
            $output .= '<li class="file"><img src="'. site_url('assets/img/' . $file) .'" width="60" height="40"> <span>'. $file .'</span></li>';
        } else {
            if (is_array($file)) {
                $output .= '<li class="folder"><img width="60" src="'. site_url('assets/css/folder.png') .'"><span>'. str_replace('\\', '', $key) . '</span>';
                // $output .= display_files($file);
                $output .= '</li>';
            }
        }
    }
    $output .= '</ul>';

    return $output;
}