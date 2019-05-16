// 获取轮播图容器
var $slidelist = $('#content_left .slideshow ul');
// 轮播图右键点击事件
$('.arrow_right').click(function() {
    if (!$slidelist.is(":animated")) {
        if ((parseInt($slidelist.css('left'))) > -1760) {
            $slidelist.animate({
                left: '-=880px'
            }, 'slow');
        } else {
            $slidelist.animate({
                left: '0px'
            }, 'slow');
        }
    }
});
// 轮播图左键点击事件
$('.arrow_left').click(function() {
    if (!$slidelist.is(":animated")) {
        if ((parseInt($slidelist.css('left'))) < 0) {
            $slidelist.animate({
                left: '+=880px'
            }, 'slow');
        } else {
            $slidelist.animate({
                left: '-1760px'
            }, 'slow');
        }
    }
});
// 轮播图自动播放
function autoplay() { //设置轮播
    timer = setInterval(function() {
        $('.arrow_right').triggerHandler("click"); //模拟触发数字按钮的click事件
    }, 3000); //设置轮播时间长度
}
// 鼠标放在轮播图上，停止轮播
$('#content_left .slideshow').hover(function() {
    clearInterval(timer);
}, autoplay);
// 触发轮播
autoplay();

/**
 * 倒计时
 * @param {Number} year    倒计时 年
 * @param {Number} month   倒计时 月
 * @param {Number} day     倒计时 日
 * @param {String} divname 绑定元素名称
 */
function countdowner(year, month, day, divname) {
    // 获取当前时间戳
    var now = new Date();
    // 获取设定日期的时间戳
    var endDate = new Date(year, month-1, day);
    var leftTime = endDate.getTime() - now.getTime();
    var dd = parseInt(leftTime / 1000 / 60 / 60 / 24, 10); //计算剩余的天数
    var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10); //计算剩余的小时数
    var mm = parseInt(leftTime / 1000 / 60 % 60, 10); //计算剩余的分钟数
    var ss = parseInt(leftTime / 1000 % 60, 10); //计算剩余的秒数
    dd = checkTime(dd);
    hh = checkTime(hh);
    mm = checkTime(mm);
    ss = checkTime(ss); //小于10的话加0
    var container = document.getElementById(divname);
    container.innerHTML = dd;
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
// 调用方法，设置指定日期获取倒数值，并写入html中，默认刷新时间为3秒
window.setInterval(function() { countdowner(2019, 6, 7, 'countdown1'); }, 1000);
window.setInterval(function() { countdowner(2019, 6, 15, 'countdown2'); }, 1000);
window.setInterval(function() { countdowner(2019, 6, 1, 'countdown3'); }, 1000);
window.setInterval(function() { countdowner(2019, 11, 2, 'countdown4'); }, 1000);
window.setInterval(function() { countdowner(2019, 6, 7, 'countdown5'); }, 1000);
