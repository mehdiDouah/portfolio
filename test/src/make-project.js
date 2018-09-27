const fs = require('fs')

write_projects('projects')

function write_projects(path) {
    fs.readdir(path, function(err, items) {
        for (var i= 0; i < items.length; i++) {
            var file = path + '/' + items[i]
            console.log('file: ' + file)
            write_html(file)
        }
    });
}

function get_description(path) {
    description = fs.readFileSync(path + '/description.txt')
    return description
}

function get_description_long(path) {
    description = fs.readFileSync(path + '/description_long.txt')
    return description
}

function write_html(path) {
    project_js = fs.readFileSync(path + '/project.json')
    project = JSON.parse(project_js)

    let description = get_description(path)
    let description_long = get_description_long(path)

    let html = "<div class='row'>\n"
    html += "<div class='col-lg-12 project'>\n"
    html += "<div class='row'>\n"
    html += "<div class='col-lg'><h2>" + project.name + "</h2></div>\n"
    html += "<div class='col-lg'><h3>" + project.date + "</h3></div>\n"
    html += "</div>\n"
    html += "<div class='row'>\n"
    html += "<div class='col-lg'><h3 class='key-word'>\n"
    for (let i = 0; i < project.key.length; i++) {
        html += "#" + project.key[i]
    }
    html += "</h3></div>\n"
    html += "</div>\n"
    html +="<div class='row'>\n"
    html +="<div class='col-xl h-100 d-inline-block illustration'>\n"
    html += "<div class='btn-prev'></div>\n"
    html += "<div class='btn-next'></div>\n"
    html += "<img src='1.jpg' alt='test' />\n"
    html += "</div>\n"
    html += "<div class='col-lg'>\n"
    html += "<p class='description'>\n"
    html += description
    html += "</p><p>\n"
    html += description_long
    html += "</p>\n"
    html += "</div>\n"
    html += "</div>\n"
    html += "<div class='row'>\n"
    html += "<div class='col-lg'>\n"
    html += "<p>\n"
    html += project.github
    html += "</p>\n"
    html += "</div>\n"
    html += "</div>\n"
    html += "</div>\n"
    html += "</div>\n"

    console.log('write in: ' + path + '/out.html')
    fs.writeFile(path + '/out.html', html)
}