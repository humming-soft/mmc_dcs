<!-- start: Javascript for validation-->
<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>

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
                            <h3>Journal</h3>
                        </div>
                        <ol class="breadcrumb navbar-text navbar-right no-bg">
                            <li class="current-parent">
                                <a class="current-parent" href="<?php echo base_url(); ?>index-2.html">
                                    <i class="fa fa-fw fa-home"></i>
                                </a>
                            </li>
                            <li class="active">
                                Journal Data Entry
                            </li>
                            <!--<li class="active">DataTables</li>-->
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header and Breadcrumbs-->
    <div class="container">
        <!-- START EDIT CONTENT -->
        <div class="row">
            <div class="col-lg-12">
                <table id="datatables-example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th  style="font-weight: 600; color: #2c97de">No</th>
                        <th  style="font-weight: 600; color: #2c97de">Project Name</th>
                        <th  style="font-weight: 600; color: #2c97de">Journal Name</th>
                        <th  style="font-weight: 600; color: #2c97de">View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sno=1;
                    foreach ($journal as $journal):?>
                        <tr>
                            <td class="text-white"><?php echo $sno; ?></td>
                            <td class="text-white"><?php echo $journal['pjct_name']; ?></td>
                            <td class="text-white"><?php echo $journal['journal_name']; ?></td>
                            <td class="text-center v-a-m">
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="" data-toggle="modal" <?php if($journal['journal_type_id']==1){?> data-target="#myModalData" class="modalData" <?php } else { ?> data-target="#myModalImage" class="modalImage" <?php } ?>  data-journalId="<?php echo $journal['journal_master_id']; ?>" data-pjctName="<?php echo $journal['pjct_name']; ?>" data-journalName="<?php echo $journal['journal_name']; ?>" data-journalType="<?php echo $journal['journal_type_name']; ?>" >Update</a>
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

<div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open_multipart('dataentry/doupload' , array('id' => 'validations'));?>
            <!--<form method=post id=updaterecord action="<?php /*/*echo base_url(); */?>project/updateProject">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Image Journal Entry </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <input type="hidden"  name="journalimage" id="journalimage">
                                <label for="mobile1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <label for="strPjctname" class="control-label" style="color: white" id="strImgPjctname" name="strImgPjctname"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <label for="strJournalName" class="control-label" style="color: white" id="strImgJournalName" name="strImgJournalName"></label>
                                </div>
                            </div>
                           <!-- <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Type</label>
                                <div class="col-sm-9">
                                    <label for="strJournalType" class=" control-label" style="color: white" id="strImgJournalType" name="strImgJournalType"></label>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="from_datepicker" class="col-sm-3 control-label">Data Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="image_datepicker" name="datadateImage">
                                    <?php echo form_error('dateFrom'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                               <!-- <?php /*if($error != ''){ echo "<font color='red'>$error</font>";}*/?>
                                --><?php /* if($success != ''){ echo "<font color='green'>$success</font>"; }*/?>
                                <label for="mobile1" class="col-sm-3 control-label">Upload Image</label>
                                <div class="col-sm-1" >
                                     <input type="file" name="userfile[]" class="form-control" id="filer_input" data-jfiler-extensions="jpg,png" multiple="multiple">
                                     <?php echo form_error('files[]'); ?>
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
                <input type="submit" class="btn btn-primary btn-sm"  name ="fileSubmit" value="Submit" id="uploader" />
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--<form method=post id=updaterecord action="<?php /*/*echo base_url(); */?>project/updateProject">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Journal Data Entry </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <?php echo form_open_multipart('dataentry/parse_data', array('id' => 'dataform','class'=>'form-horizontal'));?>
                            <div class="form-group">
                                <input type="hidden"  name="journalid" id="journalid">
                                <label for="mobile1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <label for="strPjctname" class="control-label" style="color: white" id="strPjctname" name="strPjctname"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <label for="strJournalName" class="control-label" style="color: white" id="strJournalName" name="strJournalName"></label>
                                </div>
                            </div>
                          <!--  <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Type</label>
                                <div class="col-sm-9">
                                    <label for="strJournalType" class=" control-label" style="color: white" id="strJournalType" name="strJournalType"></label>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="from_datepicker" class="col-sm-3 control-label">Data Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="data_date" name="datadate">
                                    <?php echo form_error('datadate'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_upload" class="col-sm-3 control-label">File input</label>
                                <div class="col-sm-9">
                                    <input type="file" name="file" id="exampleInputFile">
                                    <?php echo form_error('mobile'); ?>
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
                <input class="btn btn-primary btn-sm" type="submit" name ="submit" value="Submit" id="uploader">
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
    $("#dataEntry").addClass("active open");
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
        $(".modaldelete").click(function(){
            if(confirm("Do you want to delete?"))
            {
                var id = $(this).attr("data-journalId");
                $.post( "<?php echo base_url(); ?>journal/delete_journal",{id:id}, function( data ) {
                    location.reload();
                });
            }
        });
        $(".modalData").click(function(){
            var projectName = $(this).attr("data-pjctName");
            var journalId = $(this).attr("data-journalId");
            var journalName = $(this).attr("data-journalName");
           /* var journalType = $(this).attr("data-journalType");*/
            $('#journalid').val( journalId );
            $('#strPjctname').text(projectName) ;
            $('#strJournalName').text( journalName );
           /* $('#strJournalType').text( journalType );*/

        });
        $(".modalImage").click(function(){
            var projectName = $(this).attr("data-pjctName");
            var journalId = $(this).attr("data-journalId");
            var journalName = $(this).attr("data-journalName");
           /* var journalType = $(this).attr("data-journalType");*/
            $('#journalimage').val( journalId );
            $('#strImgPjctname').text(projectName) ;
            $('#strImgJournalName').text( journalName );
            /*$('#strImgJournalType').text( journalType );*/

        });
    });
    $('#data_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
    $('#image_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
</script>
