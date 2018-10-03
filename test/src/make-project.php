<?php

create_html_file_from_dir('projects');
put_html_in_file('../dist/index.html');
copy_img_in('../dist/img');
make_slider();

function copy_img_in($path) {
    $imgs = array();
    $dir = opendir('projects');

    // Collect images.
    while (false !== ($entry = readdir($dir))) {
        if ($entry !== '.' && $entry !== '..') {
            if (! is_dir($path . '/' . $entry))
                mkdir($path . '/' . $entry);

            copy_img('projects/' . $entry, $path . '/' . $entry);
        }
    }

    foreach ($imgs as $img) {
        copy($img, $path);
    }
}

function copy_img($dir_path, $dest) {
    $dir = opendir($dir_path);
    $imgs = array();

    while (false !== ($entry = readdir($dir))) {
        if ($entry !== '.' && $entry !== '..') {
            if (pathinfo($entry)['extension'] === 'png') {
                copy($dir_path . '/' . $entry, $dest . '/' . $entry);
            }
        }
    }

    return $imgs;
}

function create_html_file_from_dir($dir_path) {
    $dir = opendir($dir_path);

    while (false !== ($entry = readdir($dir))) {
        if ($entry !== '.' && $entry !== '..')
            create_html_file($dir_path . '/' . $entry);
    }
}

function put_html_in_file($file_path) {
    $file = file_get_contents('gen/index.html');

    $doc = new DOMDocument();
    $doc->loadHTML($file);
    $prj_container = $doc->getElementById('project-container');
    $fragement = $doc->createDocumentFragment();
    $dir = opendir('projects/');

    while (false !== ($entry = readdir($dir))) {
        if ($entry !== '.' && $entry !== '..') {
            $project = file_get_contents('projects/'. $entry . '/out.html');
            $fragement->appendXML($project);
        }
    }

    $prj_container->appendChild($fragement);
    file_put_contents($file_path, $doc->saveHTML());
}

function create_html_file($path) {
    $project_js = file_get_contents($path . '/project.json');
    $project = json_decode($project_js);

    $description = file_get_contents($path . '/description.txt');
    $description_long = file_get_contents($path . '/description_long.txt');

    $html = "<div class='row'>\n";
    $html .= "<div class='col-lg-8 offset-2 project'>\n";
    $html .= "<div class='row project-header'>\n";
    $html .= "<div class='col-lg'><h2>" . $project->name . "</h2></div>\n";
    $html .= "<div class='col-lg'><h3>" . $project->date . "</h3></div>\n";
    $html .= "</div>\n";
    $html .= "<div class='row'>\n";
    $html .= "<div class='col-lg'><h3 class='key-word'>\n";
    foreach ($project->key as $key) {
        $html .= "#" . $key;
    }
    $html .= "</h3></div>\n";
    $html .= "</div>\n";
    $html .= "<div class='row'>\n";
    $html .= "<div class='col-xl h-100 d-inline-block illustration'>\n";
    if ($project->nb_img > 1) {
        $html .= "<div id='".basename($path)."-btn-prev' class='btn-prev'></div>\n";
        $html .= "<div id='".basename($path)."-btn-next' class='btn-next'></div>\n";
    }
    $html .= "<img id='".basename($path)."-img' src='img/". basename($path) . "/1.png' alt='' />\n";
    $html .= "</div>\n";
    $html .= "<div class='col-lg'>\n";
    $html .= "<p class='description'>\n";
    $html .= $description;
    $html .= "</p><p>\n";
    $html .= $description_long;
    $html .= "</p>\n";
    $html .= "</div>\n";;
    $html .= "</div>\n";
    $html .= "<div class='row'>\n";
    $html .= "<div class='col-lg'>\n";
    $html .= "<a href='".$project->github."'>\n";
    $html .= $project->github;
    $html .= "</a>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";

    file_put_contents($path . '/out.html', $html);
}

function make_slider() {
    $js_code = '';
    $dir = opendir('projects');

    $js_code = file_get_contents('gen/main.js');

    while (false !== ($entry = readdir($dir))) {
        if ($entry !== '.' && $entry !== '..') {
            $js_code .= "document.addEventListener('DOMContentLoaded', ".$entry."_main);";
            $js_code .= "function ".$entry."_main() {";
            $project_js = file_get_contents('projects/' .$entry. '/project.json');
            $project = json_decode($project_js);

            $img = $entry.'_img';
            $btn_prev = $entry.'_btn_prev';
            $func_prev = 'function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                '.$img.'.attr("src", "img/'.$entry.'/"+img_id+".png");
            }';

            $btn_next = $entry.'_btn_next';
            $func_next = 'function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                '.$img.'.attr("src", "img/'.$entry.'/"+img_id+".png");
            }';

            $js_code .= 'let '.$img.' = $("#'.$entry.'-img");';
            $js_code .= 'let '.$btn_prev.' = $("#'.$entry.'-btn-prev");';
            $js_code .= 'let '.$btn_next.' = $("#'.$entry.'-btn-next");';
            $js_code .= 'let max = '.$project->nb_img.';';
            $js_code .= 'let img_id = 1;';
            $js_code .= $btn_prev.'.bind("click", '.$func_prev.');';
            $js_code .= $btn_next.'.bind("click", '.$func_next.');';
            $js_code .= "}";
        }
    }

    file_put_contents('gen/out.js', $js_code);
}

?>