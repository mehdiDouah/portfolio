import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle'
import $ from 'jquery'

$('.intro-more').click(function () {
    console.log('click on info-more')
    $('.intro-more').css('display', 'none')
    $('.intro-more-content').css('display', 'block')
})

document.addEventListener('DOMContentLoaded', DoudouSokoban_main);function DoudouSokoban_main() {let DoudouSokoban_img = $("#DoudouSokoban-img");let DoudouSokoban_btn_prev = $("#DoudouSokoban-btn-prev");let DoudouSokoban_btn_next = $("#DoudouSokoban-btn-next");let max = 4;let img_id = 1;DoudouSokoban_btn_prev.bind("click", function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                DoudouSokoban_img.attr("src", "img/DoudouSokoban/"+img_id+".png");
            });DoudouSokoban_btn_next.bind("click", function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                DoudouSokoban_img.attr("src", "img/DoudouSokoban/"+img_id+".png");
            });}document.addEventListener('DOMContentLoaded', CutCuteLimon_main);function CutCuteLimon_main() {let CutCuteLimon_img = $("#CutCuteLimon-img");let CutCuteLimon_btn_prev = $("#CutCuteLimon-btn-prev");let CutCuteLimon_btn_next = $("#CutCuteLimon-btn-next");let max = 0;let img_id = 1;CutCuteLimon_btn_prev.bind("click", function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                CutCuteLimon_img.attr("src", "img/CutCuteLimon/"+img_id+".png");
            });CutCuteLimon_btn_next.bind("click", function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                CutCuteLimon_img.attr("src", "img/CutCuteLimon/"+img_id+".png");
            });}document.addEventListener('DOMContentLoaded', Snake_main);function Snake_main() {let Snake_img = $("#Snake-img");let Snake_btn_prev = $("#Snake-btn-prev");let Snake_btn_next = $("#Snake-btn-next");let max = 5;let img_id = 1;Snake_btn_prev.bind("click", function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                Snake_img.attr("src", "img/Snake/"+img_id+".png");
            });Snake_btn_next.bind("click", function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                Snake_img.attr("src", "img/Snake/"+img_id+".png");
            });}document.addEventListener('DOMContentLoaded', Finder_main);function Finder_main() {let Finder_img = $("#Finder-img");let Finder_btn_prev = $("#Finder-btn-prev");let Finder_btn_next = $("#Finder-btn-next");let max = 0;let img_id = 1;Finder_btn_prev.bind("click", function () {
                if (img_id > 1) {
                    img_id --;
                }
                else {
                    img_id = max;
                }
                Finder_img.attr("src", "img/Finder/"+img_id+".png");
            });Finder_btn_next.bind("click", function () {
                if (img_id < max) {
                    img_id ++;
                }
                else {
                    img_id = 1;
                }
                Finder_img.attr("src", "img/Finder/"+img_id+".png");
            });}