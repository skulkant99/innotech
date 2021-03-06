@extends('Admin.layouts.layout')
@section('css_top')
@endsection
@section('css_bottom')

@endsection
@section('body')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="content">
                                
                                <div class="header">
                                    <h4 class="title"> {{$title_page}}
                                    <button class="btn btn-danger btn-edit pull-right" data-id="{{$warring->id}}">
                                            + แก้ไขข้อมูล
                                    </button> 

                                    </h4>
                                </div>
                                
                                <div class="content">
                                    <div class="nav-tabs-navigation">
                                        
                                            <div class="nav-tabs-wrapper">
                                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                    <li class="nav-item">
                                                        <a href="#pill1" class="nav-link active" data-toggle="tab" aria-expanded="true">ไทย</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#pill2" class="nav-link" data-toggle="tab" aria-expanded="false">อังกฤษ</a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        
                                    </div>
                                    
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="pill1" aria-expanded="true">
                                                {!!($warring->name_th)!!}
                                            </div>
                                            <div class="tab-pane" id="pill2" aria-expanded="false">
                                                {!!($warring->name_en)!!}
                                            </div>
                                        </div>
                                    
                                    
                                </div>
                                    
                            {{-- <h4 class="title">
                                {{$title_page}}
                                <button class="btn btn-success btn-add pull-right" >
                                    + เพิ่มข้อมูล
                                </button> 
                            </h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                <div class="table-responsive">
                                    <table id="TableList" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>ชื่อ(th)</th>
                                            <th>ชื่อ(en)</th>
                                            <th>ลำดับ</th>
                                            <th>สถานะ</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection
@section('modal')
<div class="modal" id="ModalAdd"  role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document"  style="max-width:70%;max-height:70%;">
            <div class="modal-content">
                <form id="FormAdd">
                    <input type="hidden" name="type" id="add_type" value="W">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">เพิ่ม {{$title_page}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
    
                    <div class="form-group">
                        <label for="add_detail">ชื่อ(th)</label>
                        <textarea id="add_name_th" name="name_th" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="add_detail">ชื่อ(en)</label>
                        <textarea id="add_name_en" name="name_en" class="form-control"></textarea>
                    </div>

                    <div class="row">
                          <div class="form-group col-md-6">
                              <label for="add_sort_id">ลำดับ</label>
                              <input type="text" class="form-control number-only" name="sort_id" id="add_sort_id"  placeholder="ลำดับ">
                          </div>
    
                          <div class="form-group col-md-6">
                              <label for="add_status">สถานะ</label>
                              <select  class="form-control number-only select2" name="status" id="add_status" tabindex="-1" data-placeholder="เลือก สถานะ">
                                  <option value="">เลือก</option>
                                  <option value="1">ใช้งาน</option>
                                  <option value="2">ไม่ใช้งาน</option>
                              </select>
                          </div>
    
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="ModalEdit"  role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document"  style="max-width:70%;max-height:70%;">
                <div class="modal-content">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <form id="FormEdit">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">แก้ไข {{$title_page}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            
                        <div class="form-group">
                            <label for="add_detail">ชื่อ(th)</label>
                            <textarea id="edit_name_th" name="name_th" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="add_detail">ชื่อ(en)</label>
                            <textarea id="edit_name_en" name="name_en" class="form-control"></textarea>
                        </div>

                        {{-- <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="add_sort_id">ลำดับ</label>
                                  <input type="text" class="form-control number-only" name="sort_id" id="edit_sort_id"  placeholder="ลำดับ">
                              </div>
        
                              <div class="form-group col-md-6">
                                  <label for="add_status">สถานะ</label>
                                  <select  class="form-control number-only select2" name="status" id="edit_status" tabindex="-1" data-placeholder="เลือก สถานะ">
                                      <option value="">เลือก</option>
                                      <option value="1">ใช้งาน</option>
                                      <option value="2">ไม่ใช้งาน</option>
                                  </select>
                              </div>
        
                        </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('js_top')
@endsection
@section('js_bottom')
    <script>
         var TableList = $('#TableList').dataTable({
            "ajax": {
                "url": url_gb+"/admin/premonition/list_premonition",
                "data": function ( d ) {
                    //d.myKey = "myValue";
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            "columns": [
                {"data" : "DT_RowIndex" , "className": "text-center", "searchable": false, "orderable": false},
                {"data" : "name_th"},
                {"data" : "name_en"},
                {"data" : "sort_id","className": "text-center"},
                {"data" : "status"},
                { "data": "action","className":"action text-center","searchable" : false , "orderable" : false }
            ]
         });
         $('body').on('click','.btn-add',function(data){
            ShowModal('ModalAdd');
        });
        $('body').on('click','.btn-edit',function(data){
            var btn = $(this);
            btn.button('loading');
            var id = $(this).data('id');
            $('#edit_id').val(id);
            $.ajax({
                method : "GET",
                url : url_gb+"/admin/introduction/"+id,
                dataType : 'json'
            }).done(function(rec){
                CKEDITOR.instances['edit_name_th'].setData(rec.name_th);
                CKEDITOR.instances['edit_name_en'].setData(rec.name_en);
                $('#edit_status').val(rec.status);
                $('#edit_sort_id').val(rec.sort_id);
                $('.select2').select2();
                btn.button("reset");
                ShowModal('ModalEdit');
            }).fail(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        });
        $('#FormAdd').validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            focusInvalid: false,
            rules: {

                name: {
                    required: true,
                },
            },
            messages: {

                name: {
                    required: "กรุณาระบุ",
                },
            },
            highlight: function (e) {
                validate_highlight(e);
            },
            success: function (e) {
                validate_success(e);
            },

            errorPlacement: function (error, element) {
                validate_errorplacement(error, element);
            },
            submitHandler: function (form) {

                if(CKEDITOR!==undefined){
                    for ( instance in CKEDITOR.instances ){
                        CKEDITOR.instances[instance].updateElement();
                    }
                }

                var btn = $(form).find('[type="submit"]');
                var data_ar = removePriceFormat(form,$(form).serializeArray());
                btn.button("loading");
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/introduction",
                    dataType : 'json',
                    data : $(form).serialize()
                }).done(function(rec){
                    btn.button("reset");
                    if(rec.status==1){
                        TableList.api().ajax.reload();
                        resetFormCustom(form);
                        swal(rec.title,rec.content,"success");
                        $('#ModalAdd').modal('hide');
                    }else{
                        swal(rec.title,rec.content,"error");
                    }
                }).fail(function(){
                    swal("system.system_alert","system.system_error","error");
                    btn.button("reset");
                });
            },
            invalidHandler: function (form) {

            }
        });
        $('#FormEdit').validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            focusInvalid: false,
            rules: {

                name: {
                    required: true,
                },
            },
            messages: {

                name: {
                    required: "กรุณาระบุ",
                },
            },
            highlight: function (e) {
                validate_highlight(e);
            },
            success: function (e) {
                validate_success(e);
            },

            errorPlacement: function (error, element) {
                validate_errorplacement(error, element);
            },
            submitHandler: function (form) {

                if(CKEDITOR!==undefined){
                    for ( instance in CKEDITOR.instances ){
                        CKEDITOR.instances[instance].updateElement();
                    }
                }

                var btn = $(form).find('[type="submit"]');
                var id = $('#edit_id').val();
                btn.button("loading");
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/introduction/"+id,
                    dataType : 'json',
                    data : $(form).serialize()
                }).done(function(rec){
                    btn.button("reset");
                    if(rec.status==1){
                        TableList.api().ajax.reload();
                        resetFormCustom(form);
                        swal(rec.title,rec.content,"success");
                        $('#ModalEdit').modal('hide');
                    }else{
                        swal(rec.title,rec.content,"error");
                    }
                }).fail(function(){
                    swal("system.system_alert","system.system_error","error");
                    btn.button("reset");
                });
            },
            invalidHandler: function (form) {

            }
        });
        $('body').on('click','.btn-delete',function(e){
            e.preventDefault();
            var btn = $(this);
            var id = btn.data('id');
            swal({
                title: "คุณต้องการลบใช่หรือไม่",
                text: "หากคุณลบจะไม่สามารถเรียกคืนข้อมูลกลับมาได้",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: "ใช่ ฉันต้องการลบ",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
                buttonsStyling: false
            }).then(function() {
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/information/Delete/"+id,
                    data : {ID : id}
                }).done(function(rec){
                    if(rec.status==1){
                        swal(rec.title,rec.content,"success");
                        TableList.api().ajax.reload();
                    }else{
                        swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
                    }
                }).fail(function(data){
                    swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
                });
            }).catch(function(e){
                //console.log(e);
            });
        });
        CKEDITOR.replace('add_name_th');
        CKEDITOR.replace('edit_name_th');

        CKEDITOR.replace('add_name_en');
        CKEDITOR.replace('edit_name_en');
        $('#add_status').select2();
        $('#edit_status').select2();
    </script>
@endsection
