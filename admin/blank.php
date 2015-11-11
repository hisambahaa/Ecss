<?php 
require_once __DIR__ .'/../Connections/config.php';
// the page title
$pageTitle='بلانكك';
require_once $config['base_url'].'/admin/template/includes/header.php'; ?>
  <!-- page content -->
            <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" style="min-height:600px;">
                                <div class="x_title">
                                    <h2>Plain Page</h2>
                                    <div class="clearfix"></div>
                                    <?php echo $_SERVER['REQUEST_URI']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>