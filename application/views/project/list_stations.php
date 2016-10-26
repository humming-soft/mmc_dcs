<!-- start: Javascript for validation-->
<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/sweetalert.css">
<!-- end: Javascript for validation-->
<div class="content">
    <!-- START Sub-Navbar with Header only-->
    <div class="sub-navbar sub-navbar__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header m-t-0">
                        <h3 class="m-t-0">DataTables</h3>
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
                <div class="col-lg-12">
                    <div class="col-md-8 sub-navbar-column">
                        <div class="sub-navbar-header">
                            <h3>Stations</h3>
                        </div>
                        <ol class="breadcrumb navbar-text navbar-right no-bg">
                            <li class="current-parent">
                                <a class="current-parent" href="<?php echo base_url(); ?>index-2.html">
                                    <i class="fa fa-fw fa-home"></i>
                                </a>
                            </li>
                            <li class="active">
                                List Stations
                            </li>
                            <!--<li class="active">DataTables</li>-->
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-primary pull-right" style="margin-top: 20px;" href="<?php echo base_url();?>project/add_station">
                            Add Station
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header and Breadcrumbs-->


    <div class="container">
        <!-- START EDIT CONTENT -->
        <?php if($this->session->flashdata('success')){ ?>
            <!--<div class="alert no-bg b-l-success b-l-3 b-t-gray b-r-gray b-b-gray" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                <strong class="text-white">Suscess!</strong> <span class="text-gray-lighter"><?php echo $this->session->flashdata('success'); ?>.</span>
            </div>-->
            <input type="hidden" id="message" value="<?php echo $this->session->flashdata('success')?>">
            <script type="text/javascript">
                swal({
                    title: 'Success!',
                    text:  document.getElementById("message").value+ '.',
                    type:   'success',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            </script>
        <?php } ;?>
        <?php  if($this->session->flashdata('error')){ ?>
            <!-- <div class="alert no-bg b-l-warning b-l-3 b-t-gray b-r-gray b-b-gray" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                <strong class="text-white">Faild!</strong> <span class="text-gray-lighter"><?php /*echo $this->session->flashdata('error'); */?>.</span>
            </div>-->
            <input type="hidden" id="message" value="<?php echo $this->session->flashdata('success')?>">
            <script type="text/javascript">
                swal({
                    title: 'Sorry!',
                    text:  document.getElementById("message").value+ '.',
                    type:   'error',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            </script>

        <?php } ;?>
        <div class="row">
            <div class="col-lg-12">
                <table id="datatables-example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th  style="font-weight: 600; color: #2c97de">No</th>
                        <th  style="font-weight: 600; color: #2c97de">Name</th>
                        <th  style="font-weight: 600; color: #2c97de">Region</th>
                        <th  style="font-weight: 600; color: #2c97de">Station/Depot/Region</th>
                        <th  style="font-weight: 600;color: #2c97de">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sno=1;
                    foreach ($records as $record):?>
                        <tr>
                            <td class="text-white"><?php echo $sno; ?></td>
                            <td class="text-white"><?php echo $record['spd_name']; ?></td>
                            <td class="text-white"><?php echo $record['region_name']; ?></td>
                            <td class="text-white"><?php echo $record['category_type_name']; ?></td>
                            <td class="text-center v-a-m">
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="" data-toggle="modal" data-target="#myModal1" class="modaledit" data-stationId="<?php echo $record['station_master_id']; ?>" data-categoryId="<?php echo $record['category_type_id']; ?>" data-stationName="<?php echo $record['spd_name']; ?>" data-region="<?php echo $record['region_master_id'] ; ?>" data-isActive="<?php echo $record['is_active'] ; ?>"  ><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Update">&nbsp;</span></a>
                                    <a href="" data-toggle="modal" class="modaldelete" data-stationId="<?php echo html_escape($record['station_master_id']); ?>"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete">&nbsp;</span></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $sno=$sno+1;
                    endforeach; ?>
                    </tbody>
                </table>

                <!-- END Zero Configuration -->
            </div>
        </div>
        <!-- END EDIT CONTENT -->
    </div>

</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit The Station Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <?php echo form_open('project/update_station' , array('id' => 'validations'));?>
                            <div class="form-group">
                                <input type="hidden" id="stationId" name="stationId">
                                <label for="name1" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="intCategoryId" class="form-control" id="intCategoryId">
                                        <option value="-1">Select Category</option>
                                        <?php
                                        foreach ($category as $categ):?>
                                            <option value="<?php echo $categ->category_type_id; ?>"><?php echo $categ->category_type_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('name'); ?>
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
                                        <option value="-1">Select Region</option>
                                        <?php
                                        foreach ($region as $region):?>
                                            <option value="<?php echo $region->region_master_id; ?>"><?php echo $region->region_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('name'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="project_name" class="col-sm-3 control-label">Active</label>
                                <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="1" name="isActive" id="isActive"> Is Actuve
                                    </label>
                                    <?php echo form_error('strStationName'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2"></div>

                        <!-- END Basic Elements -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary btn-sm" value="Save Changes" />
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<script>
    $("#datatables-example").DataTable();
    $('div.dataTables_filter input').attr('placeholder', 'Enter the text here');
</script>
<script>
    $("#projectMaster").addClass("active open");
    $("#stations").addClass("active open");
</script>
<script>
    /*$(document).ready(function() {
        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetes allowed");
        $("#validations").validate({
            rules: {
                strProjectName: {
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
    */    $(".modaldelete").click(function(){
            if(confirm("Do you want to delete?"))
            {
                var id = $(this).attr("data-stationId");
                $.post( "<?php echo base_url(); ?>project/delete_station",{id:id}, function( data ) {
                    location.reload();
                });
            }
        });
        $(".modaledit").click(function(){
            var stationId = $(this).attr("data-stationId");
            var categoryId = $(this).attr("data-categoryId");
            var stationName = $(this).attr("data-stationName");
            var region = $(this).attr("data-region");
            var isActive = $(this).attr("data-isActive");
            $('#intCategoryId').val( categoryId );
            $('#strStationName').val( stationName );
            $('#intRegionId').val( region );
            $('#stationId').val( stationId );
            if(isActive==1){
                $('#isActive').attr('checked',true);
            }else{
                $('#isActive').attr('checked',false);
            }
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