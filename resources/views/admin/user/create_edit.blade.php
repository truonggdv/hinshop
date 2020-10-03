@extends('admin.layouts.index')
@section('title','Quản lí thành viên')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

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
                            <a href="{{route('user.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text">Quản lí thành viên</span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    @if(isset($data))
                                        Thành viên: {{$data->name}}
                                        @else
                                        Thêm mới
                                    @endif

                                </span>
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
                               Thành viên: {{$data->name}}
                            @else
                               Thêm thành viên
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
                <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('user.update',$data->id):route('user.store')}}">
                    {{csrf_field()}}
                    @if(isset($data))
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label>Họ tên:</label>
                            <div class="input-group m-input-group">
                                <input type="text" name="name" class="form-control m-input" value="{{old('name',isset($data) ? $data->name : null)}}" placeholder="Nhập họ tên..">
                            </div>
                            <span class="m-form__help">Vui lòng nhập đúng họ tên của bạn</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Email:</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control m-input" value="{{old('email',isset($data) ? $data->email : null)}}" readonly placeholder="Nhập email..">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2">@gmail.com</span></div>
                            </div>
                        </div>
                        @if(isset($data))
                        <div class="form-group m-form__group">
                            <label class="m-checkbox m-checkbox--state-success">
                                <input type="checkbox" name="changePassword" id="changePassword"> Thay đổi mật khẩu
                                <span></span>
                            </label>
                        </div>
                        @endif
                        <div class="form-group m-form__group">
                            <label>Mật khẩu:</label>
                            <div class="input-group m-input-group">
                                <input @if(isset($data)) disabled @endif type="password" name="password" value="" class="form-control m-input password" placeholder="Nhập mật khẩu...">
                            </div>
                        </div>
{{--                        @if(!isset($data))--}}
                            <div class="form-group m-form__group">
                                <label>Nhập lại mật khẩu:</label>
                                <div class="input-group m-input-group">
                                    <input @if(isset($data)) disabled @endif type="password" name="re_password" class="form-control m-input password" placeholder="Nhập mật khẩu...">
                                </div>
                            </div>
{{--                        @endif--}}
                        <div class="m-form__group form-group">
                            <label class="mb-4" for="">Quyền</label>
                            @if(isset($data))
                                <div class="m-checkbox-inline">
                                    @foreach($role as $ro)
                                        <label class="m-checkbox">
                                            <input name="roles[]"
                                                   @foreach ($id_roles as $idr)
                                                        {{ $idr->name == $ro->name ? 'checked' : "" }}
                                                   @endforeach
                                                   value="{{ $ro->name }}" type="checkbox"> {{$ro->title}}
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <div class="m-checkbox-inline">
                                    @foreach($role as $ro)
                                        <label class="m-checkbox">
                                            <input name="roles[]" value="{{ $ro->name }}" type="checkbox"> {{$ro->title}}
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                            <span class="m-form__help">Thêm quyền cho tài khoản</span>
                        </div>
                        <div class="form-group m-form__group">
                            <div class="mb-5">
                                <label>Ảnh đại diện:</label>
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
            $(document).ready(function (){
                $("#changePassword").change(function (){
                    if($(this).is(':checked')){
                        $(".password").removeAttr('disabled');
                    }else{
                        $(".password").attr('disabled','');
                    }
                });
            });

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
