
<div class="content">
    <!-- START Sub-Navbar with Header only-->
    <div class="sub-navbar sub-navbar__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header m-t-0">
                        <h3 class="m-t-0">Forms</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header only-->

    <!-- START Sub-Navbar with Header and Breadcrumbs-->
    <div class="sub-navbar sub-navbar__header-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 sub-navbar-column">
                    <div class="sub-navbar-header">
                        <!-- <h3>Forms</h3> -->
                    </div>
                    <ol class="breadcrumb navbar-text navbar-right no-bg">
                        <li class="current-parent">
                            <a class="current-parent" href="../index.html">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Stations
                            </a>
                        </li>
                        <li class="active">Add New Station</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header and Breadcrumbs-->


    <div class="container">
        <!-- START EDIT CONTENT -->

        <div class="row">
            <div class="col-lg-12">
                <!-- START Basic Elements -->
                <h4 class="m-t-3">Add New Station</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-horizontal">
                            <?php echo form_open('project/add_new_station' , array('id' => 'validations'));?>
                            <div class="form-group">
                                <label for="name1" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="intCategoryId" class="form-control" id="intCategoryId">
                                        <option value="-1">Select Category</option>
                                        <?php
                                        foreach ($category as $categ):?>
                                            <option value="<?php echo $categ->category_type_id; ?>"><?php echo $categ->category_type_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('intCategoryId'); ?>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="project_name" class="col-sm-3 control-label"> Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="strStationName" name="strStationName">
                                        <?php echo form_error('strStationName'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name1" class="col-sm-3 control-label">Region</label>
                                    <div class="col-sm-9">
                                        <select name="intRegionId" class="form-control" id="intRegionId">
                                            <option value="none" selected="selected">Select Region</option>
                                            <?php
                                            foreach ($region as $region):?>
                                                <option value="<?php echo $region->region_master_id; ?>"><?php echo $region->region_name; ?> </option>
                                            <?php  endforeach;?>
                                        </select>
                                        <?php echo form_error('intRegionId'); ?>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="project_name" class="col-sm-3 control-label">Active</label>
                                <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="1" name="isActive" id="isActive"> Is Actuve
                                    </label>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="insert" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-block m-b-2 btn-primary" name="insert" id="insert">Save</button>
                                    </div>
                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2"></div>
                    </div>
                    <!-- END Basic Elements -->
                </div>
            </div>

            <!-- END EDIT CONTENT -->
        </div>
    </div>


<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>
<script>
    $("#projectMaster").addClass("active open");
    $("#stations").addClass("active open");
</script>
<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetes allowed");
        $("#validations").validate({
            rules: {
                strProjectName: {
                    minlength: 2,
                    required: true
                },
                strProjectDesc: {
                    minlength: 2,
                    required: true
                },
                dateFrom:{
                    required: true
                },
                dateTo:{
                    required: true
                }
            },
            messages: {
                strProjectName: {
                    required: "Project Name required"
                },
                strProjectDesc: {
                    required: "Project Description is required"
                },
                dateFrom: {
                    required: "Project Start Date is Required  required"
                },
                dateTo: {
                    required: "Project End Date is required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
                jQuery(element.parent()).addClass('has-error m-b-1'); // to show error on element also
            }

        });
    });
    $('#from_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
    $('#to_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
</script>
<!--<script>
    // Hide loader
    (function() {
        var bodyElement = document.querySelector('body');
        bodyElement.classList.add('loading');

        document.addEventListener('readystatechange', function() {
            if(document.readyState === 'complete') {
                var bodyElement = document.querySelector('body');
                var loaderElement = document.querySelector('#initial-loader');

                bodyElement.classList.add('loaded');
                setTimeout(function() {
                    bodyElement.removeChild(loaderElement);
                    bodyElement.classList.remove('loading', 'loaded');
                }, 200);
            }
        });
    })();
</script>-->