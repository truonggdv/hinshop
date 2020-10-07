@extends('admin.layouts.index')
@section('title','Quản lí thành viên')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        @role('admin')
        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Quản lí thành viên</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">Quản lí thành viên</span>
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
                            Danh sách thành viên
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <a href="{{route('user.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon mb-4">
                    <span>
                        <i class="la la-calendar-check-o"></i>
                        <span>Thêm thành viên</span>
                    </span>
                </a>
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                                <strong>Thông báo !</strong> {{session('success')}}
                            </div>
                        @endif
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                            <thead>
                            <tr>
                                <th style="width:5%">STT</th>
                                <th style="width:20%">Họ tên</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <br>
                            <h4>Danh sách Admin hệ thống</h4>
                            <br>
                            @foreach($data_admin as $key => $item)
                            <tr>
                                <th scope="row"> {{$item->id}} </th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td style="width: 15%;">
                                    <a href="{{route('user.edit',[$item->id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="{{route('user.destroy',[$item->id])}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">XÓA THÀNH VIÊN</h5>
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
                        </table>
                        <br>
                        <hr>
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th style="width:20%">Họ tên</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <br>
                            <h4>Danh sách thành viên hệ thống</h4>
                            <br>
                            @foreach($data_member as $key => $item)
                            <tr>
                                <th scope="row" style="width:5%"> {{$item->id}} </th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td style="width: 15%;">
                                    <a href="{{route('user.edit',[$item->id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="{{route('user.destroy',[$item->id])}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">XÓA THÀNH VIÊN</h5>
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
                        </table>
                        <br>
                        <hr>
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th style="width:20%">Họ tên</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <br>
                            <h4>Tất cả thành viên</h4>
                            <br>
                            @foreach($data as $key => $item)
                            <tr>
                                <th scope="row" style="width:5%"> {{$item->id}} </th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td style="width: 15%;">
                                    <a href="{{route('user.edit',[$item->id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="{{route('user.destroy',[$item->id])}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">XÓA THÀNH VIÊN</h5>
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
                        </table>
                    </div>
                </div>

                <!--end::Section-->

            </div>

            <!--end::Form-->
        </div>
        <!-- END: Subheader -->
        @else
            <div style="width: 100%" class="alert alert-danger text-center" role="alert">
                <strong>Thông báo !</strong> Bạn không có quyền truy cập vào trang này !
            </div>
            @endrole
    </div>
    @stop
