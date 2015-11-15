<?php
use \McKay\Flash;
 ?>
</div>
</div> 

            </div>
            <!-- /page content -->
        </div>

    </div>
 <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/icheck/icheck.min.js"></script>

    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/custom.js"></script>

    <!-- moris js -->
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/moris/raphael-min.js"></script>
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/moris/morris.js"></script>
    <script src="<?php echo $config['http_base_url'].'admin/template/';?>js/ecss.min.js"></script>
    
    <script src="<?php echo $config['http_base_url'] ?>admin/template/js/parsley/parsley.min.js"></script>
    <script src="<?php echo $config['http_base_url'] ?>admin/template/js/parsley/ar.js"></script>

    <script type="text/javascript" src="<?php echo $config['http_base_url'] ?>admin/template/js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo $config['http_base_url'] ?>admin/template/js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?php echo $config['http_base_url'] ?>admin/template/js/notify/pnotify.nonblock.js"></script>

<?php foreach(Flash::all() as $flash) { ?>
<script>
var stack_center = {"dir1": "down", "dir2": "right", "firstpos1": 25, "firstpos2": ($(window).width() / 2) - (Number(PNotify.prototype.options.width.replace(/\D/g, '')) / 2)};
$(window).resize(function(){
    stack_center.firstpos2 = ($(window).width() / 2) - (Number(PNotify.prototype.options.width.replace(/\D/g, '')) / 2);
});
     new PNotify({
            type:"<?php echo $flash['type'] == 'notice' ? 'warning' : $flash['type'] ?>",
            text: '<?php echo $flash['message']; ?>',
            stack: stack_center
        });
</script>
<? } Flash::clear(); ?>

</body>

</html>