<div class="form-group">
    <label class="control-label col-md-3" for="year_name"><?php echo $ecss_lang['ACADEMY_STRUCTURE']['YEAR']['YEAR_NAME'] ?><span class="required">*</span>
    </label>
    <div class="col-md-7">
    <input type="text" value='<?php echo !empty($yearRow) ? $yearRow['year_name'] : null ?>' name='year_name' id="year_name" required="required" class="form-control col-md-7 col-xs-12" />
    </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <a href='index.php' class="btn btn-default pull-left">
            <i class="fa fa-close"></i> <?php echo $ecss_lang['CANCEL'] ?></a>
            <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-save"></i> <?php echo $ecss_lang['SUBMIT'] ?>
            </button>
        </div>
    </div>
