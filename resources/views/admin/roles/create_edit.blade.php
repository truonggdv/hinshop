@extends('admin.layouts.index')
@section('title','Phân quyền')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Phân quyền</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('role.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text">Phân quyền</span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">Chỉnh sửa quyền người dùng</span>
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
                            @if(isset($data))
                                Quyền: {{$data->title}}
                            @else
                                Thêm mới
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mt-5">
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
                <form class="m-form m-form--fit m-form--label-align-right" method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('role.update',$data->id):route('role.store')}}">
                    {{csrf_field()}}
                    @if(isset($data))
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label>Tên</label>
                            <div class="input-group m-input-group">
                                <input type="text" name="title" class="form-control m-input" value="{{old('name',isset($data) ? $data->title : null)}}" placeholder="Nhập tên quyền..">
                            </div>
                            <span class="m-form__help">Tên quyền không được phép trùng</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Key</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control m-input" value="{{old('name',isset($data) ? $data->name : null)}}" placeholder="Nhập key..">
                            </div>
                            <span class="m-form__help">Key không được phép trùng</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control" id="message" rows="3" placeholder="Mô tả chức năng..">@if(isset($data)) {{$data->description}} @endif</textarea>
                        </div>
                        <div class="m-form__group form-group">
                            <label class="mb-4" for="">Chức năng</label>
                            <div class="m-checkbox-inline">
                                @if(isset($data))
                                    @foreach($permission as $per)
                                        <label class="m-checkbox">
                                            <input name="permission_id[]" value="{{ $per->name }}"
                                                   @foreach ($id_permisson as $idp)
                                                        {{ $idp->name == $per->name ? 'checked' : "" }}
                                                   @endforeach
                                                   type="checkbox"> {{$per->title}}
                                            <span></span>
                                        </label>
                                    @endforeach
                                @else
                                    @foreach($permission as $per)
                                        <label class="m-checkbox">
                                            <input name="permission_id[]" value="{{ $per->name }}" type="checkbox"> {{$per->title}}
                                            <span></span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                            <span class="m-form__help">Chọn chức năng tương ứng..</span>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            @if(isset($data))
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            @else
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            @endif
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- END: Subheader -->
    </div>
@stop
