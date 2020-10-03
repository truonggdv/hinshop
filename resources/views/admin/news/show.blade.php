@extends('admin.layouts.index')
@section('title','Quản lí bài viết')
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Bài đăng</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('new.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text">Quản lí bài viết</span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">{{$data->title}}</span>
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
                            Xem trước
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <h3>Tiêu đề:</h3>
                <br>
                <h4>{{$data->title}}</h4>
                <br>
                <h3>Mô tả</h3>
                {!! $data->description !!}
                <br>
                {!! $data->content !!}
            </div>
            <hr>
            <div class="pb-3 ml-3">
                <a href="{{route('new.edit',[$data->id])}}" class="btn btn-success">Chỉnh sửa</i></a>
                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="{{route('new.destroy',[$data->id])}}">
                    Xóa bài viết
                </button>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">XÓA BÀI VIẾT</h5>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
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
        <!-- END: Subheader -->
    </div>
@stop
