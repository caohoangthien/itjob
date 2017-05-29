$(document).ready(function(){
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
    });

    var search = {
        title: '',
        address_id: '',
        company: ''
    };

    $('#search-name').on('keyup', function(){
        $('#new-job').hide();
        $('#job-result').empty();
        search.title = $(this).val();
        var url =  $(this).data('url');
        $.ajax({
            url : url,
            type : "post",
            dataType:"json",
            data : search,
            success : function (result){
                if (result.length == 0) {
                    $('#message-result').text('Không tìm thấy công việc phù hợp.');
                } else {
                    $('#message-result').text('Tìm thấy ' + result.length + ' công việc phù hợp.');
                    var html = '';
                    $.each( result, function( key, value ) {
                        html += '<li class="list-group-item">';
                        html += '<p class="job-title"><a>' + value.title + '</a></p>';
                        html += '<p class="job-company"><a><b>' + value.company.name + '</b></a> - <a><b>' + value.address.name + '</b></a></p>';
                        html += '<p class="job-salary">' + value.salary.salary + ' | Ngày đăng: ' + value.created_at + '</p>';
                        html += '</li>';
                    });
                    $('#job-result').html(html);
                }
            }
        });
    });

    $('#search-company').on('keyup', function(){
        $('#new-job').hide();
        $('#job-result').empty();
        search.company = $(this).val();
        var url =  $(this).data('url');
        $.ajax({
            url : url,
            type : "post",
            dataType:"json",
            data : search,
            success : function (result){
                if (result.length == 0) {
                    $('#message-result').text('Không tìm thấy công việc phù hợp.')
                } else {
                    $('#message-result').text('Tìm thấy ' + result.length + ' công việc phù hợp.');
                    var html = '';
                    $.each( result, function( key, value ) {
                        html += '<li class="list-group-item">';
                        html += '<p class="job-title"><a>' + value.title + '</a></p>';
                        html += '<p class="job-company"><a><b>' + value.company.name + '</b></a> - <a><b>' + value.address.name + '</b></a></p>';
                        html += '<p class="job-salary">' + value.salary.salary + ' | Ngày đăng: ' + value.created_at + '</p>';
                        html += '</li>';
                    });
                    $('#job-result').html(html);
                }
            }
        });
    });

    $("#search-address").change(function() {
        $('#new-job').hide();
        $('#job-result').empty();
        search.address_id = $(this).val();
        var url =  $(this).data('url');
        $.ajax({
            url : url,
            type : "post",
            dataType:"json",
            data : search,
            success : function (result){
                if (result.length == 0) {
                    $('#message-result').text('Không tìm thấy công việc phù hợp.')
                } else {
                    $('#message-result').text('Tìm thấy ' + result.length + ' công việc phù hợp.');
                    var html = '';
                    $.each( result, function( key, value ) {
                        html += '<li class="list-group-item">';
                        html += '<p class="job-title"><a>' + value.title + '</a></p>';
                        html += '<p class="job-company"><a><b>' + value.company.name + '</b></a> - <a><b>' + value.address.name + '</b></a></p>';
                        html += '<p class="job-salary">' + value.salary.salary + ' | Ngày đăng: ' + value.created_at + '</p>';
                        html += '</li>';
                    });
                    $('#job-result').html(html);
                }
            }
        });
    });


});