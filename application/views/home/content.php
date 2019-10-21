<script type="text/javascript">
    
    
    $(document).ready(function() {
        
    });
    
    function show1(){
        $('#form_show1')[0].reset();
        $('#modal_show1').modal('show');
        $.ajax({
            url : "<?php echo base_url(); ?>home/get_lb_ajax_desc1",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('[name="desc1"]').val(data.status);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert("Error json " + errorThrown);
            }
        });
    }
    
    function savedesc1(){
        var desc1 = document.getElementById('desc1').value;
        if(desc1 === ''){
            alert("please fill your description");
        }else{
            $('#btnSaveDesc1').text('Saving...'); //change button text
            $('#btnSaveDesc1').attr('disabled',true); //set button disable 
            
            // ajax adding data to database
            $.ajax({
                url : "<?php echo base_url(); ?>home/prosesdesc1",
                type: "POST",
                data: $('#form_show1').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    alert(data.status);
                    $('#modal_show1').modal('hide');
                    // get text desc 1
                    getDesc1();

                    $('#btnSaveDesc1').text('Save'); //change button text
                    $('#btnSaveDesc1').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert("Error json " + errorThrown);
                    $('#btnSaveDesc1').text('Save'); //change button text
                    $('#btnSaveDesc1').attr('disabled',false); //set button enable 
                }
            });
        }
    }
    
    function getDesc1(){
        // desc desc 1
        $.ajax({
            url : "<?php echo base_url(); ?>home/get_lb_ajax_desc1",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('#lbdesc1').html(data.status);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert("Error json " + errorThrown);
            }
        });
    }
    
    function picture1(){
        $('#form_pic1')[0].reset();
        $('#modal_pic1').modal('show');
    }
    
    function savepic1(){
        $('#btnSavePic1').text('Saving...'); //change button text
        $('#btnSavePic1').attr('disabled',true); //set button disable 
        
        var file_data = $('#file').prop('files')[0];
        // ajax adding data to database
        var form_data = new FormData();
        form_data.append('file', file_data);

        $.ajax({
            url: "<?php echo base_url(); ?>home/prosesimg1",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (response) {
                alert(response.status);
                $('#modal_pic1').modal('hide');
                // get change gambar
                getPic1();
                
                $('#btnSavePic1').text('Save'); //change button text
                $('#btnSavePic1').attr('disabled',false); //set button enable 

            },error: function (response) {
                alert(response.status);
                $('#btnSavePic1').text('Save'); //change button text
                $('#btnSavePic1').attr('disabled',false); //set button enable 
            }
        });
    }
    
    function getPic1(){
        // desc desc 1
        $.ajax({
            url : "<?php echo base_url(); ?>home/get_pic1",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('#imgPic1').attr("src", data.status);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert("Error json " + errorThrown);
            }
        });
    }
    
    function show2(){
        $('#form_show2')[0].reset();
        $('#modal_show2').modal('show');
        $.ajax({
            url : "<?php echo base_url(); ?>home/get_lb_ajax_desc2",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('[name="desc2"]').val(data.status);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert("Error json " + errorThrown);
            }
        });
    }
    
    function savedesc2(){
        var desc2 = document.getElementById('desc2').value;
        if(desc2 === ''){
            alert("please fill your description");
        }else{
            $('#btnSaveDesc2').text('Saving...'); //change button text
            $('#btnSaveDesc2').attr('disabled',true); //set button disable 
            
            // ajax adding data to database
            $.ajax({
                url : "<?php echo base_url(); ?>home/prosesdesc2",
                type: "POST",
                data: $('#form_show2').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    alert(data.status);
                    $('#modal_show2').modal('hide');
                    // get text desc 2
                    getDesc2();

                    $('#btnSaveDesc2').text('Save'); //change button text
                    $('#btnSaveDesc2').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert("Error json " + errorThrown);
                    $('#btnSaveDesc2').text('Save'); //change button text
                    $('#btnSaveDesc2').attr('disabled',false); //set button enable 
                }
            });
        }
    }
    
    function getDesc2(){
        $.ajax({
            url : "<?php echo base_url(); ?>home/get_lb_ajax_desc2",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('#lbdesc2').html(data.status);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert("Error json " + errorThrown);
            }
        });
    }
    
</script>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"> Description 1</h4>
                    </div>
                    <div class="content">
                        <br>
                        <p id="lbdesc1" style="cursor:  pointer;" onclick="show1();" class="category">
                            <?php
                            if(strlen($lbdesc1) > 0){
                                echo $lbdesc1;
                            }else{
                                echo 'Your description';
                            }
                            ?>
                        </p>
                        <br>
                        <img id="imgPic1" style="cursor: pointer" onclick="picture1();" src="<?php echo $pic1; ?>" class="img-thumbnail">
                    </div>
                    <div class="footer">
                        <!--
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Open
                            <i class="fa fa-circle text-danger"></i> Bounce
                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"> Description 2</h4>
                    </div>
                    <div class="content">
                        <br>
                        <p id="lbdesc2" style="cursor:  pointer;" onclick="show2();" class="category">
                            <?php
                            if(strlen($lbdesc2) > 0){
                                echo $lbdesc2;
                            }else{
                                echo 'Your description';
                            }
                            ?>
                        </p>
                    </div>
                    <div class="footer">
                        <!--
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Open
                            <i class="fa fa-circle text-danger"></i> Bounce
                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap modal desc 1 -->
<div class="modal fade" id="modal_show1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3>Description 1</h3>
            </div>
            <div class="modal-body form">
                <form id="form_show1" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="desc1" id="desc1" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveDesc1" onclick="savedesc1();" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap modal picture 2 -->
<div class="modal fade" id="modal_pic1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3>Background Picture 1</h3>
            </div>
            <div class="modal-body form">
                <form id="form_pic1" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Background</label>
                            <div class="col-md-10">
                                <input type="file" id="file" name="file" class="form-control" placeholder="Backgroud header file" accept="image/*">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSavePic1" onclick="savepic1();" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap modal desc 2 -->
<div class="modal fade" id="modal_show2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3>Description 2</h3>
            </div>
            <div class="modal-body form">
                <form id="form_show2" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="desc2" id="desc2" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveDesc2" onclick="savedesc2();" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>