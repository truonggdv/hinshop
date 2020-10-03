@extends('admin.layouts.index')
@section('title','Xử lí đơn hàng')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Xử lí đơn hàng</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">Xử lí đơn hàng</span>
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
                            Đơn hàng
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                {{-- <a href="{{route('bill.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon mb-4">
                    <span>
                        <i class="la la-calendar-check-o"></i>
                        <span>Thêm quyền người dùng</span>
                    </span>
                </a> --}}
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
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Hoạt động
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
                                                Chưa xử lí
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content" role="tab">
                                                Đã xử lí
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="m_widget2_tab1_content">
        
                                        <!--Begin::Timeline 3 -->
                                        <div class="m-timeline-3">
                                            <div class="m-timeline-3__items">
                                                <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>STT</th>
                                                        <th>Khách hàng</th>
                                                        <th>Số điện thoại</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Email</th>
                                                        <th>Giá</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($data as $key => $item)
                                                        <tr class="text-center">
                                                            <td>{{$key + 1}}</td>
                                                            <td> {{$item->name}} </td>
                                                            <td> {{$item->phone}} </td>
                                                            <td> {{$item->address}} </td>
                                                            <td> @if(isset($item->email))
                                                                {{$item->email}}
                                                                @else
                                                                    Không có
                                                                @endif
                                                                
                                                             </td>
                                                            <td> {{number_format($item->total)}} VNĐ</td>
                                                            <td>
                                                                <form action="{{ route('bill.update',$item->id)}}" method="post">
                                                                    {{csrf_field()}}
                                                                    <button style="font-family: 'Roboto', sans-serif;" type="submit" class="btn btn-danger">Xử lí</button>
                                                                    <input type="hidden" name="_method" value="PUT">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
        
                                        <!--End::Timeline 3 -->
                                    </div>
                                    <div class="tab-pane" id="m_widget2_tab2_content">
        
                                        <!--Begin::Timeline 3 -->
                                        <div class="m-timeline-3">
                                            <div class="m-timeline-3__items">
                                                <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id_1">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>STT</th>
                                                        <th>Khách hàng</th>
                                                        <th>Số điện thoại</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Email</th>
                                                        <th>Giá</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($data_bill as $key => $item)
                                                        <tr class="text-center">
                                                            <td>{{$key + 1}}</td>
                                                            <td> {{$item->name}} </td>
                                                            <td> {{$item->phone}} </td>
                                                            <td> {{$item->address}} </td>
                                                            <td> @if(isset($item->email))
                                                                {{$item->email}}
                                                                @else
                                                                    Không có
                                                                @endif
                                                                
                                                             </td>
                                                            <td> {{number_format($item->total)}} VNĐ</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
        
                                        <!--End::Timeline 3 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-footer">
                        {{-- {{ $data->links() }} --}}
                    </div>
                </div>

                <!--end::Section-->

            </div>
            <script>
                $(document).ready( function () {
                    $('#table_id').DataTable();
                    $('#table_id_1').DataTable();
                } );
            </script>
            <!--end::Form-->
        </div>
        <!-- END: Subheader -->
    </div>
@stop
