$(document).ready(function () {
    $(".deleteSubmit").click(function () {
        if (!confirm("Do you want to delete this data?")) {
            event.preventDefault();
        }
    });

    $("#confirm-send-email").click(function () {
        if (!confirm("Do you want to send report to email?")) {
            event.preventDefault();
        }
    });
});
