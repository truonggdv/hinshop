@extends('admin.layouts.index')
@section('title','Từ khóa ngôn ngữ')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Từ khóa</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Từ khóa</span>
                            </a>
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
                            Từ khóa
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <a href="{{route('key.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon mb-4">
                    <span>
                        <i class="la la-calendar-check-o"></i>
                        <span>Thêm bài viết</span>
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
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tiêu đề</th>
{{--                                <th>Nội dung</th>--}}
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                                <tr class="text-center">
                                    <td style="width: 5%">{{$key + 1}}</td>
                                    <td>{{$item->title}}</td>
{{--                                    <td>{{$item->description}}</td>--}}
                                    <td class="text-center" style="width: 8%;">
                                        <a href="{{route('key.edit',[$item->id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="{{route('key.destroy',[$item->id])}}">
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
                                            <h5 class="modal-title" id="exampleModalLabel">XÓA TỪ KHÓA</h5>
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
                        </table>

                        {{--<form action="{{route('translate.export')}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">Export</button>
                        </form>
                    <form class="mt-5" action="{{route('translate.import')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label>
                                Thêm file
                            </label>
                            <br>
                            <input id="file_language" type="file" name="file_language" class="hidden" accept=".xlsx, .xls, .csv, .ods">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>--}}
                    </div>
                    <div class="panel-footer">
{{--                                                {{ $data->links() }}--}}
                    </div>
                </div>

                <!--end::Section-->

            </div>

            <!--end::Form-->
        </div>
        <!-- END: Subheader -->
    </div>
@stop
