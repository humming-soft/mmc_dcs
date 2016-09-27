
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
                        <h3>Project</h3>
                    </div>
                    <ol class="breadcrumb navbar-text navbar-right no-bg">
                        <li class="current-parent">
                            <a class="current-parent" href="<?php echo base_url(); ?>index-2.html">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            List Project
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
<!-- START EDIT CONTENT --><!--
<div class="row text-center text-danger"><?php /*echo $message; */?> </div>-->
<div class="row">
<div class="col-lg-12">
<table id="datatables-example" class="table table-striped table-bordered">
<thead>
<tr>
    <th  style="font-weight: 600; color: #2c97de">No</th>
    <th  style="font-weight: 600; color: #2c97de">Project Name</th>
    <th  style="font-weight: 600; color: #2c97de">Start Date</th>
    <th  style="font-weight: 600;color: #2c97de">End Date</th>
    <th  style="font-weight: 600;color: #2c97de">Actions</th>
</tr>
</thead>
<tbody>
<?php $sno=1;
foreach ($records as $record):?>
<tr>
    <td class="text-white"><?php echo $sno; ?></td>
    <td class="text-white"><?php echo $record->pjct_name; ?></td>
    <td class="text-white"><?php echo $record->pjct_from; ?></td>
    <td class="text-white"><?php echo $record->pjct_to; ?></td>
    <td class="text-center v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <a href="" data-toggle="modal" data-target="#myModal1" class="modaledit" data-projectId="<?php echo $record->pjct_master_id; ?>" data-pjctName="<?php echo $record->pjct_name; ?>" data-pjtFrom="<?php echo $record->pjct_from	; ?>" data-pjtTo="<?php echo $record->pjct_to ; ?>" ><span class="glyphicon glyphicon-edit">&nbsp;</span></a>
            <a href="#" data-toggle="modal" class="modaldelete" data-projectId="<?php echo html_escape($record->pjct_master_id); ?>"><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
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
    <!-- start: Javascript for validation-->
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>

    <!-- end: Javascript for validation-->
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method=post id=updaterecord action="<?php echo base_url(); ?>project/updateProject">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                </div>
                <input type="hidden" class="form-control" id="projectId" name="projectId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="project_name" class="col-sm-3 control-label">Project Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="strProjectName" name="strProjectName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="from_datepicker" class="col-sm-3 control-label">From</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  id="from_datepicker" name="dateFrom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="to_datepicker" class="col-sm-3 control-label">To</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  id="to_datepicker" name="dateTo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary btn-sm" value="Save Changes" />
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
$(".modaldelete").click(function(){
        if(confirm("Do you want to delete?"))
        {
            var id = $(this).attr("data-projectId");
            $.post( "<?php echo base_url(); ?>project/deleteProject",{id:id}, function( data ) {
                location.reload();
            });
        }
});
$(".modaledit").click(function(){
            var projectId = $(this).attr("data-projectId");
            var pjctName = $(this).attr("data-pjctName");
            var pjtFrom = $(this).attr("data-pjtFrom");
            var pjtTo = $(this).attr("data-pjtTo");
                $('#projectId').val( projectId );
                $('#strProjectName').val( pjctName );
                $('#from_datepicker').val( pjtFrom );
                $('#to_datepicker').val( pjtTo );

        });
 });
    $("#datatables-example").DataTable();
    $('#from_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
    $('#to_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
</script>
