<!-- start: Javascript for validation-->
<script src="<?php /*echo base_url(); */?>assets/jquery/jquery.min.js"></script>
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
    <div class="sub-navbar sub-navbar__header-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-8 sub-navbar-column">
                        <div class="sub-navbar-header">
                            <h3>Project</h3>
                        </div>
                        <ol class="breadcrumb navbar-text navbar-right no-bg">
                            <li class="current-parent">
                                <a class="current-parent" href="<?php echo base_url(); ?>index-2.html">
                                    <i class="fa fa-fw fa-home"></i>
                                </a>
                            </li>
                            <li class="active">
                                List Projects
                            </li>
                            <!--<li class="active">DataTables</li>-->
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-primary pull-right" style="margin-top: 20px;" href="<?php echo base_url();?>project/add_project">
                            Add Project
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
                        <th  style="font-weight: 600; color: #2c97de">Project Name</th>
                        <th  style="font-weight: 600; color: #2c97de">Description</th>
                        <th  style="font-weight: 600; color: #2c97de">Start Date</th>
                        <th  style="font-weight: 600;color: #2c97de">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sno=1;
                    foreach ($records as $record):?>
                        <tr>
                            <td class="text-white"><?php echo $sno; ?></td>
                            <td class="text-white"><?php echo $record->pjct_name; ?></td>
                            <td class="text-white"><?php echo $record->pjct_desc; ?></td>
                            <td class="text-white"><?php echo $record->pjct_from; ?></td>
                            <td class="text-center v-a-m">
                                <?php
                                //split the array as comma seperated value
                                $stationdat=$stations[$record->pjct_master_id];
                                ?>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="" data-toggle="modal" data-target="#myModal1" class="modaledit" data-projectId="<?php echo $record->pjct_master_id; ?>" data-pjctName="<?php echo $record->pjct_name; ?>" data-pjtFrom="<?php echo $record->pjct_from	; ?>" data-pjtTo="<?php echo $record->pjct_to ; ?>" data-desc="<?php echo $record->pjct_desc ; ?>" data-contract="<?php echo $record->cont_name ; ?>"  data-parking="<?php echo $record->has_parking ; ?>"  data-depot="<?php echo $record->has_depot ; ?>"  ><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Update">&nbsp;</span></a>
                                    <a href="" data-toggle="modal" class="modaldelete" data-projectId="<?php echo html_escape($record->pjct_master_id); ?>"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete">&nbsp;</span></a>
                                    <a href="" data-toggle="modal" data-target="#myModalStation" class="modalAddStation" data-projectId="<?php echo html_escape($record->pjct_master_id); ?>" data-stationDetails="<?php echo $stationdat; ?>"  data-pjctName="<?php echo $record->pjct_name; ?>"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Add Stations">&nbsp;</span></a>
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
           <?php echo form_open('project/update_project' , array('id' => 'validations'));?>
            <!--<form method=post id=updaterecord action="<?php /*/*echo base_url(); */?>project/updateProject">-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit The Project Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <input type="hidden" id="projectId" name="projectId">
                                            <label for="project_name" class="col-sm-3 control-label">Project Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="strProjectName" name="strProjectName">
                                                <?php echo form_error('strProjectName'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="project_name" class="col-sm-3 control-label">Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="strProjectDesc" name="strProjectDesc">
                                                <?php echo form_error('strProjectDesc'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="project_name" class="col-sm-3 control-label">Cotractor name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="strContractName" name="strContractName">
                                                <?php echo form_error('strProjectDesc'); ?>
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
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Parking </label>
                                            <div class="col-sm-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="intParking" id="intParking1" value="1"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="intParking" id="intParking0" value="0"> No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Depot </label>
                                            <div class="col-sm-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="intDepot" id="intDepot1" value="1">Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="intDepot" id="intDepot0" value="0">No
                                                </label>
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
<div class="modal fade" id="myModalStation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('project/add_update_station' , array('id' => 'validations'));?>
            <!--<form method=post id=updaterecord action="<?php /*/*echo base_url(); */?>project/updateProject">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit The Project Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <input type="hidden" id="projectMasterId" name="projectMasterId">
                                <label for="inputEmail3" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <label for="strPjctname" class="control-label" style="color: white" id="strPjctname" name="strPjctname"></label>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Stations </label>
                                <div class="col-sm-9">
                                    <select id="multiple" class="form-control select2-multiple select2-input" name="station[]"  multiple="multiple" style="width:100%;">
                                    <optgroup label="SELECT THE STATIONS">
                                        <?php foreach ($allStation as $allst):?>
                                            <option value="<?php echo $allst->station_master_id; ?>"><?php echo $allst->spd_name; ?> </option>
                                       <?php endforeach; ?>
                                   </optgroup>;
                                    </select>
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
    $("#subProject").addClass("active open");
</script>
<script>
/*$(document).ready(function() {
   *//* jQuery.validator.addMethod("fullname", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetes allowed");*//*
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
});*/
$(".modaldelete").click(function(){
        if(confirm("Do you want to delete?"))
        {
            var id = $(this).attr("data-projectId");
            $.post( "<?php echo base_url(); ?>project/delete_project",{id:id}, function( data ) {
                location.reload();
            });
        }
    });
$(".modaledit").click(function(){
            var projectId = $(this).attr("data-projectId");
            var pjctName = $(this).attr("data-pjctName");
            var pjtFrom = $(this).attr("data-pjtFrom");
            var pjtTo = $(this).attr("data-pjtTo");
            var pjtDesc = $(this).attr("data-desc");
            var contractName=$(this).attr("data-contract");
            var parking=$(this).attr("data-parking");
            var depot=$(this).attr("data-depot");
                $('#projectId').val( projectId );
                $('#strProjectName').val( pjctName );
                $('#strProjectDesc').val( pjtDesc );
                $('#from_datepicker').val( pjtFrom );
                $('#to_datepicker').val( pjtTo );
                $('#strContractName').val( contractName );
        if(parking==1){
                $('#intParking1').attr('checked',true);
        }if(parking==0){
                $('#intParking0').attr('checked',true);
        }
        if(depot==1){
                $('#intDepot1').attr('checked',true);
        }if(depot==0){
                $('#intDepot0').attr('checked',true);
        }
        });
    $(".modalAddStation").click(function(){
        var projectId = $(this).attr("data-projectId");
        var pjctName = $(this).attr("data-pjctName");
        var	statdat = $(this).attr("data-stationDetails");
        var statdat1 = statdat.split(',777,');
        for (var i = 0; i < statdat1.length; i++)
        {
            var roledat2 = statdat1[i].split(',');
            for (var k = 0; k < roledat2.length-1; k++)
            {
                $('#multiple').val(roledat2);
                /*$('#multiple').val(["3", "2"]).trigger("change");*/
            }
        }
        $('#projectMasterId').val( projectId );
        $('#strPjctname').text(pjctName)
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

<script src="<?php echo base_url(); ?>assets/vendor/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/plugins-init.js"></script>