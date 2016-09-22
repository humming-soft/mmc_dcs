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
<!-- START EDIT CONTENT -->
<div class="row">
<div class="col-lg-12">
<table id="datatables-example" class="table table-striped table-bordered">
<thead>
<tr>
    <th>Project Name</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<tr>
    <td class="text-white">Tiger Nixon</td>
    <td>System Architect</td>
    <td>Edinburgh</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Garrett Winters</td>
    <td>Accountant</td>
    <td>Tokyo</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Ashton Cox</td>
    <td>Junior Technical Author</td>
    <td>San Francisco</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Cedric Kelly</td>
    <td>Senior Javascript Developer</td>
    <td>Edinburgh</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Airi Satou</td>
    <td>Accountant</td>
    <td>Tokyo</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Brielle Williamson</td>
    <td>Integration Specialist</td>
    <td>New York</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Herrod Chandler</td>
    <td>Sales Assistant</td>
    <td>San Francisco</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Rhona Davidson</td>
    <td>Integration Specialist</td>
    <td>Tokyo</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Colleen Hurst</td>
    <td>Javascript Developer</td>
    <td>San Francisco</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Sonya Frost</td>
    <td>Software Engineer</td>
    <td>Edinburgh</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Jena Gaines</td>
    <td>Office Manager</td>
    <td>London</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Quinn Flynn</td>
    <td>Support Lead</td>
    <td>Edinburgh</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Charde Marshall</td>
    <td>Regional Director</td>
    <td>San Francisco</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Haley Kennedy</td>
    <td>Senior Marketing Designer</td>
    <td>London</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
<tr>
    <td class="text-white">Tatyana Fitzpatrick</td>
    <td>Regional Director</td>
    <td>London</td>
    <td class="text-right v-a-m">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-default"><i class="fa fa-close"></i></button>
        </div>
    </td>
</tr>
</tbody>
</table>
<!-- END Zero Configuration -->
</div>
</div>

<!-- END EDIT CONTENT -->
</div>
<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/dataTables.bootstrap.min.js"></script>

</div>
<script>
    $(document).ready(function() {
    });
    $("#datatables-example").DataTable();
</script>
<script>
    document.getElementById("projectMaster").className="active open";
    document.getElementById("subProject").className="active open";
</script>