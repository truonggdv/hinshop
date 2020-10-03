@extends('admin.layouts.index')
@section('title','Ngôn ngữ hệ thống')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Ngôn ngữ hệ thống</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('language.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text">Ngôn ngữ hệ thống</span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">@if(isset($data)) Chỉnh sửa chức năng @else Thêm mới @endif</span>
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
                            @if(isset($data))
                                Chỉnh sửa: {{$data->title}}
                            @else
                                Thêm mới
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mt-5">
                {{--                <div class="alert alert-danger" role="alert">--}}
                {{--                    <strong>Thông báo !</strong> Quyền đã tồn tại--}}
                {{--                </div>--}}
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
                <form class="m-form m-form--fit m-form--label-align-right" method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('language.update',$data->id):route('language.store')}}">
                    {{csrf_field()}}
                    @if(isset($data))
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label>Tên</label>
                            <div class="input-group m-input-group">
                                <input type="text" name="title" class="form-control m-input" value="{{old('name',isset($data) ? $data->title : null)}}" placeholder="Thêm quốc gia...">
                            </div>
                            <span class="m-form__help">Quốc gia chuyển đổi ngôn ngữ</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Key</label>
                            <div class="input-group">
                                <input type="text" name="locale" value="{{old('name',isset($data) ? $data->locale : null)}}" class="form-control m-input" placeholder="Nhập key..">
                            </div>
                            <span class="m-form__help">Key không được phép trùng</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control" id="message" rows="3" placeholder="Mô tả..">@if(isset($data)) {{$data->description}} @endif</textarea>
                        </div>
                        <div class="form-group m-form__group">
                            <div class="mb-5">
                                <label>Hình ảnh đại diện:</label>
                                <br>
                                <input type="file" id="files" name="image" />
                                <br/>
                                <img src="{{\App\Library\Files::media(old('image', isset($data) ? $data->image : null) )}}" class="mt-5" width="100px" height="100px" id="image" />
                            </div>
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
        <script>
            document.getElementById("files").onchange = function () {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("image").src = e.target.result;
                };

                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);

            };
        </script>
    </div>
@stop
