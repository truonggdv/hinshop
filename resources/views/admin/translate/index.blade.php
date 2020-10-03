@extends('admin.layouts.index')
@section('title','Từ khóa ngôn ngữ')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Biên dịch</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">Biên dịch</span>
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
                            Biên dịch
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
{{--                <a href="{{route('key.create')}}" class="btn btn-success m-btn m-btn--custom m-btn--icon mb-4">--}}
{{--                    <span>--}}
{{--                        <i class="la la-calendar-check-o"></i>--}}
{{--                        <span>Thêm bài viết</span>--}}
{{--                    </span>--}}
{{--                </a>--}}
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
                            <form action="{{route('translate.store')}}" method="post">
                                {{csrf_field()}}
                                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1 mb-5">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Translate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($arr as $item)
                                        <tr class="text-center">
                                            <td style="width: 5%">
                                                <input style="border: none" type="text" name="language_key_id[]" value="{{$item['id']}}" readonly class="form-control m-input">
                                            </td>
                                            <td style="width: 30%">{{$item['title']}}</td>
                                            <td>
                                                <div class="input-group m-input-group">
                                                    <input type="text" value="{{$item['language']}}" name="title[]" class="form-control m-input" autocomplete="off" placeholder="Translate...">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div style="float: left" class="m-form__actions">
                                        <button type="submit" class="btn btn-primary mt-3">Translate</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="panel-footer">
                        <form class="mt-3" action="{{route('translate.export')}}" method="post">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-primary ml-4">Export</button>
                        </form>
                        <form class="mt-5" action="{{route('translate.import')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label>
                                Thêm file
                            </label>
                            <br>
                            <input id="file_language" type="file" name="file_language" class="hidden" accept=".xlsx, .xls, .csv, .ods">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>

                <!--end::Section-->

            </div>

            <!--end::Form-->
        </div>
        <!-- END: Subheader -->
    </div>
@stop
