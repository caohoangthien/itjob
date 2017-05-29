$(document).ready(function () {
    $('.btn-active-job').on('click', function () {
        var thisJob = $(this);
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: "get",
            success: function (data) {
                if (data.status) {
                    if (thisJob.text() == 'Active') {
                        thisJob.text('Deactive');
                    } else {
                        thisJob.text('Active');
                    }
                }
            }
        });
    });
});