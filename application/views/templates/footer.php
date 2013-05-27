</div>
<!-- /container -->

<script src="<?php echo base_url(); ?>application/views/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/views/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>application/views/js/bootstrap-datepicker.js"></script>
<script>

    $(document).ready(function () {
        $('.datepicker').datepicker();

        $('.book-button').bind('click',function(){
            $('#myModalLabel').html($(this).data('username'));
            $('#myModalBoby').html($(this).data('foodname'));
            $('#foodId').val($(this).data('foodid'));
            $('#foodOwnerId').val($(this).data('userid'));
            $('#myModal').modal('show');
        });

        $('#book-confirm').bind('click',function(){
            $('#bookform').submit();
        })

    });

</script>
</body>
</html>