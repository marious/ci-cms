<?php

function add_meta_title($string) {
    $CI =& get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>');
}

function btn_delete($uri) {
 return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>', array(
                'onclick' => "return confirm('You are about to delete a record. This cannot bt undone. Are you sure?');"
               ));
}


function make_active($uri) {
    if (uri_string() == $uri) {
        return 'active';
    }
    return '';
}

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


function e($string) {
    return htmlentities($string);
}

function get_menu($array, $child = false) {

    $CI =& get_instance();

    $str = '';

    if (count($array)) {
        $str .= $child == false ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

        foreach ($array as $item) {

            $active = $CI->uri->segment(1) == $item['slug'] ? true : false;

            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a class="dropdown-toggle" data-toggle="dropdown"  href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
                $str .= '<b class="caret"></b></a>' . PHP_EOL;
                $str .= get_menu($item['children'], true);
            }
            else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="'. site_url(e($item['slug'])) .'">' .  e($item['title']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;

        }
        $str .= '</ul>' . PHP_EOL;
    }
    return $str;

}



function article_link($article) {
    return 'articles/' . intval($article->id) . '/' . e($article->slug);
}

function article_links($articles) {
    $string = '<ul class="recent">';
    foreach ($articles as $article) {
        $url = article_link($article);
        $string .= '<li>' . anchor($url, e($article->title)) . '</li>';
    }
    $string .= '</ul>';
    return $string;
}



function get_excerpt($article, $numwords = 50) {
    $string = '';

    $string .= '<p class="post-info"><i class="glyphicon glyphicon-time"></i> Posted by '. $article->name .' on '. date('F d, Y', strtotime($article->pubdate)) .'</p>' . PHP_EOL;
    $string .= '<hr>' . PHP_EOL;
    $string .= '<img src="'. $article->image .'" class="img-responsive">' . PHP_EOL;

    $url = 'articles/' . intval($article->id) . '/' . e($article->slug);
    $string .= '<h3>'. anchor($url, e($article->title)) .'</h3>' . PHP_EOL;
    $string .= '<p>' .  strip_tags(word_limiter($article->body, $numwords)) . '</p>' . PHP_EOL;
    $string .= anchor($url, 'Read More <span class="glyphicon glyphicon-chevron-right"> </span>', 'class="btn btn-primary"') . PHP_EOL;;
    return $string;
}


function get_carousel() {
    $CI =& get_instance();

    $articles = $CI->Article_M->get_with_user('pubdate', 'desc', 5);

    $output = '<div class="carousel-inner">' . PHP_EOL;
    foreach ($articles as $article) {
        $output .=  $articles[0]->id == $article->id ? '<div class="item active">' : '<div class="item">' . PHP_EOL;
        $output .= '<img src="' . $article->image . '">' . PHP_EOL;
        $output .= '<div class="carousel-caption">' . PHP_EOL;
        $output .= '<h4>'. anchor(article_link($article), $article->title) .'</h4>' . PHP_EOL;
        $output .= '<p>' . strip_tags(word_limiter($article->body, 50)) . '</p>' . PHP_EOL;
        $output .= '</div>' . PHP_EOL;
        $output .= '</div>' . PHP_EOL;
    }
    $output .= '</div>' . PHP_EOL;

    $output .= '<ul class="list-group slider-list col-sm-4">' . PHP_EOL;

    $i = 0;
    foreach ($articles as $article) {
        $output .= '<li data-target="#myCarousel" data-slide-to="'. $i .'" class="list-group-item active">'. PHP_EOL .
                '<img src="'. $article->image .'" class="img-slide img-thumbnail"><h4>'. e($article->title) .
                '</h4><p>'. strip_tags(word_limiter($article->body, 10)) .'</p></li>' . PHP_EOL;
        $i += 1;
    }
    $output .= '</ul>';

    return $output;
}


function display_article($article) {
    $string = '';

    $string .= '<p class="post-info"><i class="glyphicon glyphicon-time"></i> Posted by '. $article->name .' on '. date('F d, Y', strtotime($article->pubdate)) .'</p>' . PHP_EOL;
    $string .= '<hr>' . PHP_EOL;
    $string .= '<img src="'. $article->image .'" class="img-responsive">' . PHP_EOL;

    $string .= '<h3>'. $article->title .'</h3>' . PHP_EOL;
    $string .= $article->body . PHP_EOL;
    return $string;
}



