<div class="content">
<!-- START Sub-Navbar with Header only-->
<div class="sub-navbar sub-navbar__header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header m-t-0">
                    <h3 class="m-t-0">Project</h3>
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
                    <h3>Project</h3>
                </div>
                <ol class="breadcrumb navbar-text navbar-right no-bg">
                    <li class="current-parent">
                        <a class="current-parent" href="../index.html">
                            <i class="fa fa-fw fa-home"></i>
                        </a>
                    </li>
                    <li class="active">
                        Add Project
                    </li>
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
<h4 class="m-t-3 text-uppercase">Add New Project</h4>
<div class="row">
    <div class="col-lg-6">
       <?php echo form_open('project/add_new_project' , array('id' => 'validations'));?>
            <div class="form-group">
                <label for="project_name" class="col-sm-3 control-label">Project Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="project_name" name="strProjectName">
                    <?php echo form_error('strProjectName'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="from_datepicker" class="col-sm-3 control-label">From</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  id="from_datepicker" name="dateFrom">
                    <?php echo form_error('dateFrom'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="to_datepicker" class="col-sm-3 control-label">To</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  id="to_datepicker" name="dateTo">
                    <?php echo form_error('dateTo'); ?>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
       <?php echo form_close();?>
    </div>
    <div class="col-md-4 col-md-offset-2"></div>
</div>
</div>
</div>
<!-- END EDIT CONTENT -->
</div>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>

<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetes allowed");
        $("#validations").validate({
            rules: {
                strProjectName: {
                    fullname: true,
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