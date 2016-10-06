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
                                Journal
                            </a>
                        </li>
                        <li class="active">Add Journal</li>
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
                <h4 class="m-t-3">Add New Journal</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-horizontal">
                            <?php echo form_open('journal/add_new_journal' , array('id' => 'validations'));?>
                            <div class="form-group">
                                <label for="name1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
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
                                        foreach ($journalType as $journal):?>
                                            <option value="<?php echo $journal->journal_type_id; ?>"><?php echo $journal->journal_type_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('name'); ?>
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

<script>
    document.getElementById("projectMaster").className="active open";
    document.getElementById("subJournal").className="active open";
</script>
<script type="text/javascript">

    $(document).ready(function() {

        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetes allowed");
        $("#validations").validate({
            rules: {
                name: {
                    fullname: true,
                    minlength: 2,
                    required: true
                },
                mobile:{
                    required: true,
                    number: true
                },
                email:{
                    required: true,
                    email: true
                }
            },
            messages: {
                name: {
                    required: "Name required"
                },
                mobile: {
                    required: "Mobile required"
                },
                email: {
                    required: "Email required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
                jQuery(element.parent()).addClass('has-error m-b-1'); // to show error on element also
            }

        });
    });

</script>

<!--<script type="text/javascript">

    $(document).ready(function() {
        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetes allowed");     
        $("#validations").validate({
            rules: {
               name: {
                fullname: true,
                minlength: 2,
                required: true
            },
            mobile:{            
                required: true,
                number: true
            },
            email:{         
                required: true,
                email: true
            }               
        },
        messages: {
         name: {
            required: "Name required"         
        },
        mobile: {
            required: "Mobile required"
        },
        email: {
            required: "Email required"
        }           
    },
    highlight: function(element) {
        $(element).parent('div').addClass('has-error m-b-1');
    },
    unhighlight: function(element) {
        $(element).parent('div').removeClass('has-error m-b-1');
    }
});
    });

</script>-->