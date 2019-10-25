'use strict';

$(document).ready(function () {

    $('.js-add-task').on('submit', function () {

        let $nameField = $('#name');
        let $emailField = $('#email');
        let $taskField = $('#task');
        let pattern = /^[a-z0-9_.-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

        // Trim all
        let email = $emailField.val().trim();
        let name = $nameField.val().trim();
        let task = $taskField.val().trim();

        $('.is-invalid').removeClass('is-invalid');

        // Validate Name
        if (name.length < 2) {
            $nameField.addClass('is-invalid');

            return false;
        }

        // Validate Email
        if (email.length < 5) {
            $emailField.addClass('is-invalid');

            return false;

        } else {

            if (email.search(pattern) !== 0) {
                $emailField.addClass('is-invalid');

                return false;
            }
        }

        // Validate Task
        if (task.length < 5) {
            $taskField.addClass('is-invalid');

            return false;
        }

        return true;
    });

});
