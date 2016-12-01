/**
 * Created by chenm on 2016/12/1.
 */
$(document).ready(function () {
    // initJoinBtn();
});

function initJoinBtn() {
    $('.join-btn').one('click', addJoinBtnEvent);
    $('.joined-btn').one('click', addJoinedBtnEvent);
}

function addJoinBtnEvent(event) {
    var btn = $(this);
    btn.addClass('disabled');
    var id = $(this).attr('data-id');
    $.post('/api/activity/join',
        {
            username: username,
            activity_id: id
        }, function (data, status) {
            if (data['status'] == 'success') {
                btn.html('已加入');
                btn.removeClass('join-btn')
                    .removeClass('disabled')
                    .removeClass('btn-pink')
                    .addClass('joined-btn');
                btn.one('click', addJoinedBtnEvent);
            } else {
                btn.removeClass('disable');
                btn.one('click', addJoinBtnEvent);
            }
        })
}

function addJoinedBtnEvent(event) {
    var btn = $(this);
    btn.addClass('disabled');
    var id = $(this).attr('data-id');
    $.ajax({
        url: '/api/activity/join',
        type: 'DELETE',
        data: {
            username: username,
            activity_id: id
        },
        success: function (data, status) {
            if (data['status'] == 'success') {
                btn.html('加入');
                btn.removeClass('joined-btn')
                    .removeClass('disabled')
                    .addClass('btn-pink')
                    .addClass('join-btn');
                btn.one('click', addJoinBtnEvent);
            } else {
                btn.removeClass('disable');
                btn.one('click', addJoinedBtnEvent);
            }
        }
    });
}
