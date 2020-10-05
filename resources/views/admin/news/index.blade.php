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
                                <span class="m-nav__link-text">Bài đăng</span>
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
                            Danh sách bài viết
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
{{--                <form  action="{{url('admin/new/search/searchform')}}" method="get">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="search" id="search" class="form-control input-lg" autocomplete="off" placeholder="Tìm kiếm bài viết.." />--}}
{{--                        <div id="list-item"><br>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    {{ csrf_field() }}--}}
{{--                </form>--}}
                <form action="{{url('admin/new/search/searchform')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control input-lg" autocomplete="off" placeholder="Tìm kiếm bài viết.." />
                            <div id="list-item"><br>
                            </div>
                     </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                                <div class="form-group m-form__group row">
                                    <label for="example-date-input" class="col-2 col-form-label">Ngày bắt đầu</label>
                                    <div class="col-4">
                                        <input name="time_start" class="form-control m-input" type="date" id="example-date-input">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-date-input" class="col-2 col-form-label">Ngày kết thúc</label>
                                    <div class="col-4">
                                        <input name="time_end" class="form-control m-input" type="date" id="example-date-input">
                                    </div>
                                </div>
                        </div>
                        <div class="form-group m-form__group text-center ml-4">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
                <br />
                <a href="{{route('new.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon mb-4">
                    <span>
                        <i class="la la-calendar-check-o"></i>
                        <span>Thêm bài viết</span>
                    </span>
                </a>
                <!--begin::Section-->
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
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
                                <th>Mô tả</th>
                                <th>Ảnh đại diện</th>
                                <th>Ảnh mở rộng</th>
                                <th>Người đăng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{$item->title}}</td>
                                <td style="width: 20%;"> {!! $item->description !!} </td>
                                <td class="text-center">
                                    <img width="150" height="100" src="{{\App\Library\Files::media( $item->image )}}" alt="" />
                                    <p class="mt-2 text-center">Kích thước thật: {{$item->width}} x {{$item->height}}</p>
                                </td>
                                <td class="text-center">
                                    <img width="150" height="100" src="{{\App\Library\Files::media( $item->image_extension )}}" alt="" />
                                    <p class="mt-2 text-center">Kích thước thật: {{$item->width_extension}} x {{$item->height_extension}}</p>
                                </td>
                                <td class="text-center">{{$item->author}}</td>
                                <td class="text-center" style="width: 15%;">
                                    <a href="{{route('new.show',[$item->id])}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('new.edit',[$item->id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal" data-action="{{route('new.destroy',[$item->id])}}">
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

                                $(document).ready(function(){

                                    $('#search').keyup(function(){
                                        var query = $(this).val();
                                        if(query != '')
                                        {
                                            var _token = $('input[name="_token"]').val();
                                            $.ajax({
                                                url:"{{ route('search') }}",
                                                method:"POST",
                                                data:{query:query, _token:_token},
                                                success:function(data){
                                                    $('#list-item').fadeIn();
                                                    $('#list-item').html(data);
                                                }
                                            });
                                        }
                                    });

                                    $(document).on('click', 'li', function(){
                                        $('#search').val($(this).text());
                                        $('#list-item').fadeOut();
                                    });

                                });
                            </script>
                        </table>
                    </div>
                </div>

                <!--end::Section-->
                {{$data->links()}}
            </div>

            <!--end::Form-->
        </div>
        <!-- END: Subheader -->
    </div>
@stop
