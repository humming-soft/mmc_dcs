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
                                List Journal
                            </li>
                            <!--<li class="active">DataTables</li>-->
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-primary pull-right" style="margin-top: 20px;" href="<?php echo base_url();?>journal/add_journal">
                            Add Journal
                        </a>
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
                        <th  style="font-weight: 600; color: #2c97de">Type</th>
                        <th  style="font-weight: 600; color: #2c97de">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sno=1;
                    foreach ($journal as $journal):?>
                        <tr>
                            <td class="text-white"><?php echo $sno; ?></td>
                            <td class="text-white"><?php echo $journal['pjct_name']; ?></td>
                            <td class="text-white"><?php echo $journal['journal_name']; ?></td>
                            <td class="text-white"><?php echo $journal['journal_type_name']; ?></td>
                            <td class="text-center v-a-m">
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="" data-toggle="modal" data-target="#myModal1" class="modaledit" data-journalId="<?php echo $journal['journal_master_id']; ?>" data-projectId="<?php echo $journal['pjct_master_id']; ?>" data-journalName="<?php echo $journal['journal_name'] ?>" data-typeId="<?php echo $journal['journal_type_id']; ?>" ><span class="glyphicon glyphicon-edit">&nbsp;</span></a>
                                    <a href="" data-toggle="modal" class="modaldelete" data-journalId="<?php echo $journal['journal_master_id']; ?>"><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
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
            <?php echo form_open('journal/update_journal' , array('id' => 'validations'));?>
            <!--<form method=post id=updaterecord action="<?php /*/*echo base_url(); */?>project/updateProject">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit The Journal Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <?php echo form_open('journal/update_journal' , array('id' => 'validations'));?>
                            <div class="form-group">
                                <label for="name1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="journalId" name ="journalId">
                                    <select name="intPjtId" class="form-control" id="intPjtId">
                                        <option value="-1">Select Project</option>
                                        <?php
                                        foreach ($records as $rec):?>
                                            <option value="<?php echo $rec->pjct_master_id; ?>"><?php echo $rec->pjct_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('name'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="strJournal" name ="strJournal">
                                    <?php echo form_error('mobile'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name1" class="col-sm-3 control-label">Journal Type</label>
                                <div class="col-sm-9">
                                    <select name="intJournalType" class="form-control" id="intJournalType">
                                        <option value="-1">Select Journal Type</option>
                                        <?php
                                        foreach ($journalType as $journaType):?>
                                            <option value="<?php echo $journaType->journal_type_id; ?>"><?php echo $journaType->journal_type_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('name'); ?>
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
</script>
<script>
    document.getElementById("projectMaster").className="active open";
    document.getElementById("subJournal").className="active open";
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
        $(".modaledit").click(function(){
            var projectId = $(this).attr("data-projectId");
            var journalId = $(this).attr("data-journalId");
            var journalName = $(this).attr("data-journalName");
            var typeId = $(this).attr("data-typeId");
            $('#intPjtId').val( projectId );
            $('#strJournal').val( journalName );
            $('#intJournalType').val( typeId );
            $('#journalId').val( journalId );

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
