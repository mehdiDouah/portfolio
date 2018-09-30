<?php

create_html_file_from_dir('projects');
put_html_in_file('../dist/index.html');
copy_img_in('../dist/img');

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
            if (pathinfo($entry)['extension'] === 'jpg') {
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
    $file = file_get_contents($file_path);

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
    $html .= "<div class='col-lg-12 project'>\n";
    $html .= "<div class='row'>\n";
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
    $html .= "<div class='btn-prev'></div>\n";
    $html .= "<div class='btn-next'></div>\n";
    $html .= "<img src='img/". basename($path) . "/1.jpg' alt='test' />\n";
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
    $html .= "<p>\n";
    $html .= $project->github;
    $html .= "</p>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";

    file_put_contents($path . '/out.html', $html);
}

?>