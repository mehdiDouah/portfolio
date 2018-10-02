import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle'
import $ from 'jquery'

$('.intro-more').click(function () {
    console.log('click on info-more')
    $('.intro-more').css('display', 'none')
    $('.intro-more-content').css('display', 'block')
})

