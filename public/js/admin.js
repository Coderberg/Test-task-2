'use strict';

$(document).ready(function () {

    let $body = $('body');

    $body.on('click', '.js-set-completed', function () {

        let taskId = parseInt($(this).attr('id'), 10);

        updateStatus(taskId, 'completed');

        $(this).attr('class', 'far fa-check-square text-success cursor-pointer js-set-created');
        $(this).parent('p').parent('.card').addClass('completed');

    });

    $body.on('click', '.js-set-created', function () {

        let taskId = parseInt($(this).attr('id'), 10);

        updateStatus(taskId, 'created');

        $(this).attr('class', 'far fa-square text-primary cursor-pointer js-set-completed');
        $(this).parent('p').parent('.card').removeClass('completed');
    });

    function updateStatus(taskId, status) {

        $.post("/admin/update-status/" + taskId, {status: status}).done(function (response) {
            console.log(response);
        });
    }

    $('.js-edit-task').click(function () {

        let taskId = parseInt(($(this).attr('id')).replace('edit-', ''), 10);

        hideForms();

        $('#js-task-description-' + taskId).hide();
        $('#js-edit-task-description-' + taskId).show();

    });

    $('.jb-btn-cancel').click(function () {
        hideForms();
    });

    function hideForms() {
        $('.js-task-description').show();
        $('.js-edit-task-description').hide();
    }

});
