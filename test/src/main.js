import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle'
import $ from 'jquery'

document.addEventListener('DOMContentLoaded', mario_main);function mario_main() {let mario_img = $("#mario-img");let mario_btn_prev = $("#mario-btn-prev");let mario_btn_next = $("#mario-btn-next");let max = 3;let img_id = 1;mario_btn_prev.bind("click", function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                mario_img.attr("src", "img/mario/"+img_id+".png");
            });mario_btn_next.bind("click", function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                mario_img.attr("src", "img/mario/"+img_id+".png");
            });}document.addEventListener('DOMContentLoaded', luigi_main);function luigi_main() {let luigi_img = $("#luigi-img");let luigi_btn_prev = $("#luigi-btn-prev");let luigi_btn_next = $("#luigi-btn-next");let max = 1;let img_id = 1;luigi_btn_prev.bind("click", function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                luigi_img.attr("src", "img/luigi/"+img_id+".png");
            });luigi_btn_next.bind("click", function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                luigi_img.attr("src", "img/luigi/"+img_id+".png");
            });}