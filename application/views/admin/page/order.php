<section>
    <h2>Order Pages</h2>
    <p class="alert alert-info">Drag to order pages and the click 'Save'</p>
    <div id="orderResult"></div>
    <input type="button" id="save" value="Save" class="btn btn-primary">
</section>


<script>

    $(function() {
        $.post("<?= site_url('admin/page/order_ajax'); ?>", {}, function(data) {
            $('#orderResult').html(data);
        });

        $('#save').on('click', function(e) {
            oSortable = $('.sortable').nestedSortable('toArray');

            $('#orderResult').slideUp(function() {
                $.post("<?= site_url('admin/page/order_ajax') ?>", { sortable: oSortable }, function(data) {
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                });
            });

            // e.preventDefault();
        });

    });

</script>