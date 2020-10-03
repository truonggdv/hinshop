@extends('admin.layouts.index')
@section('title','Quản lí thành viên')
@section('content')
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css" />
    <div style="margin-top: -4%" class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Quản lí danh mục</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">Quản lí danh mục</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh mục tin tức
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    @if(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            @foreach($errors->all() as $err)
                                <strong>Thông báo !</strong> {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            <strong>Thông báo !</strong> {{session('success')}}
                        </div>
                    @endif
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('categories.store')}}">
                        {{csrf_field()}}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label for="">Danh mục cha:</label>
                                <select class="form-control" name="parent_id" id="">
                                    <option value="0">----ROOT----</option>
                                    {!! getCategories($data, 0, "", 0 ) !!}
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Tên danh mục</label>
                            <input required type="text" class="form-control m-input m-input--square" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên danh mục..">
                            <span class="m-form__help">Nhập tên danh mục</span>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                <button type="reset" class="btn btn-secondary">Hủy</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <h3 class="my-3" style="font-family: 'Roboto', sans-serif"><span class="m-nav__link-text">Quản lí danh mục</span></h3>
                    @if(session()->has('confirm_delete'))
                        <div class="alert alert-warning">Danh mục này có danh mục con, tiếp tục xoá?</div>
                        <div class="text-center my-2">
                            <a href="{{ url('admin/categories/destroy/'.session('confirm_delete')) }}?confirm=1" class="btn btn-danger">Xóa</a>
                            <a href="{{ url('admin/categories')}}" class="btn btn-danger">Quay lại</a>
                        </div>
                    @endif
                    <div style="font-family: 'Roboto', sans-serif;font-size: 15px;overflow-x: hidden" class="vertical-menu">
                        <div class="item-menu active">Danh mục </div>
                        <div class="m-scrollable" data-scrollable="true" style="height: 400px;overflow-x: hidden">
                            {!! listCategory($data,0,"") !!}
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">XÓA DANH MỤC      </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có muốn xóa?
                                    </div>
                                    <div class="modal-footer">
                                        <form id="form-delete" role="form" method="POST" enctype="multipart/form-data" action="">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Xóa</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){

                                $('#exampleModal').on('show.bs.modal', function(e) {
                                    var action=$( e.relatedTarget).data('action');
                                    $('#form-delete').attr('action',action );
                                });

                            });


                        </script>
                    </div>
                </div>
            </div>
            <!--end::Form-->
        </div>
        <!-- END: Subheader -->
    </div>
@stop
