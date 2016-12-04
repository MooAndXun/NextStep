/**
 * Created by chenm on 2016/12/1.
 */
$(document).ready(function() {
    $('ul.tabs').tabs();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 16, // Creates a dropdown of 15 years to control year
        format: 'yyyy-mm-dd',
        today: '今天',
        close: '完成',
        clear: '清除',
        monthsFull: [ '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
    });
    $('select').material_select();
});