</div>
<!-- /container -->
<div class="footer" style="text-align: center;border-top: 1px solid #EAEAE2;
    height: 80px;
    margin-top: 30px;
    width: 100%;">
    <a href="/about" target="_blank">关于我们</a>
</div>

<script src="<?php echo base_url(); ?>application/views/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/views/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>application/views/js/bootstrap-datepicker.js"></script>
<script>

    $(document).ready(function () {
        $('.datepicker').datepicker();

        $('.book-button').bind('click', function () {
            $('#myModalLabel').html($(this).data('username'));
            $('#myModalBoby').html($(this).data('foodname'));
            $('#foodId').val($(this).data('foodid'));
            $('#foodOwnerId').val($(this).data('userid'));
            $('#foodOwnerName').val($(this).data('username'));
            $('#myModal').modal('show');
        });

        $('#book-confirm').bind('click', function () {
            $('#bookform').submit();
        });

        $('.booked_persons_span').hide();

        $('.booked_persons_link').bind('click', function () {
            var food_id = $(this).data('foodid');
            var base_url = $(this).data('baseurl');
            var booked_persons_span_id = 'booked_persons_' + food_id;
            var booked_persons_span = $('#' + booked_persons_span_id);
            var is_get_data = booked_persons_span.data('isGetData');
            if (is_get_data) {
                booked_persons_span.toggle();
            } else {
                $.getJSON(base_url+"orders/get_by_post",{food_id:food_id}, function (data) {
                    var items = [];
                    $.each(data['results'], function () {
                        var owner_name=this.ownerName;
                        var owner_id=this.owner.objectId;
                        items.push("<a href="+base_url+'users/'+owner_id+"'>"+owner_name+"</a> ");
                    });
                    $('<span/>', {
                        html: items.join('')
                    }).appendTo(booked_persons_span);
                    booked_persons_span.data('isGetData',true);
                    booked_persons_span.show();
                });
            }
        });

    });

</script>
</body>
</html>