@extends('admin.layouts.index')
@section('title','Quản lí sản phẩm')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader mb-4">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">Quản lí sản phẩm</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{route('dashboard.index')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                            <a href="{{route('product.index')}}" class="m-nav__link">
                                <span class="m-nav__link-text">Quản lí sản phẩm</span>
                            </a>
                        </li>
                        <li class="m-nav__separator mr-3">-  </li>
                        <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    @if(isset($data))
                                        Sản phẩm: {{$data->title}}
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
                                Sản phẩm: {{$data->title}}
                            @else
                                Thêm sản phẩm
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
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
            <form class="m-form m-form--fit m-form--label-align-right"  method="{{isset($data)?"POST":"POST"}}" enctype="multipart/form-data" action="{{ isset($data) ? route('product.update',$data->id):route('product.store')}}">
                {{csrf_field()}}
                @if(isset($data))
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="row">
                    <div class="col-xl-6 col-lg-6 mt-5">
                        <div class="m-portlet__body">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group m-form__group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control m-input title" type="text" name="title" value="{{old('title',isset($data) ? $data->title : null)}}">
                                <br/>
                            </div>
                            @if(isset($data))
                                <div class="form-group m-form__group mb-5">
                                    <label class="col-form-label">Slug</label>
                                    <input class="form-control m-input slug" type="text" name="slug" disabled="" value="{{old('slug',isset($data) ? $data->slug : null)}}" id="example-search-input">
                                    <br>
                                    <label class="m-checkbox m-checkbox--state-success">
                                        <input type="checkbox" name="changeSlug" id="changeTitle"> Chỉnh sửa Slug
                                        <span></span>
                                    </label>
                                </div>
                            @endif
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group m-form__group">
                                <label>Giá gốc (VNĐ)</label>
                                <input class="form-control m-input" type="number" name="price_old" value="{{old('price_old',isset($data) ? $data->price : null)}}">
                                <br/>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group m-form__group">
                                <label>Sale (%)</label>
                                <input class="form-control m-input" type="number" name="sale" value="{{old('sale',isset($data) ? $data->sale : null)}}">
                                <br/>
                            </div>
                            <div class="input-group m-input-group mb-5">
                                <label class="ml-4">Mô tả sản phẩm:</label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea required class="ckeditor" name="description" id="m_summernote_1" >
                                        @if(isset($data))
                                            {{$data->description}}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="input-group m-input-group mb-5">
                                <label class="ml-4">Nội dung chi tiết sản phẩm:</label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea required class="ckeditor" name="content" id="m_summernote_1" >
                                        @if(isset($data))
                                            {{$data->content}}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 mt-5">
                        <div class="mb-5">
                            <label>Ảnh sản phẩm:</label>
                            <br>
                            <input type="file" id="files" name="image" />
                            <br/>
                            <img src="{{\App\Library\Files::media(old('image', isset($data) ? $data->image : null) )}}" class="mt-5" width="100px" height="150px" id="image" />
                        </div>
                        <div class="mb-5">
                            <label>Ảnh chi tiết sản phẩm 1:</label>
                            <br>
                            <input type="file" id="detailed_image_12" name="detailed_image_1" />
                            <br/>
                            <img src="{{\App\Library\Files::media(old('detailed_image_1', isset($data) ? $data->detailed_image_1 : null) )}}" class="mt-5" width="100px" height="150px" id="detailed_image_1" />
                        </div>
                        <div class="mb-5">
                            <label>Ảnh chi tiết sản phẩm 2:</label>
                            <br>
                            <input type="file" id="detailed_image_22" name="detailed_image_2" />
                            <br/>
                            <img src="{{\App\Library\Files::media(old('detailed_image_2', isset($data) ? $data->detailed_image_2 : null) )}}" class="mt-5" width="100px" height="150px" id="detailed_image_2" />
                        </div>
                        <div class="mb-5">
                            <label>Ảnh chi tiết sản phẩm 3:</label>
                            <br>
                            <input type="file" id="detailed_image_32" name="detailed_image_3" />
                            <br/>
                            <img src="{{\App\Library\Files::media(old('detailed_image_3', isset($data) ? $data->detailed_image_3 : null) )}}" class="mt-5" width="100px" height="150px" id="detailed_image_3" />
                        </div>
                        <div class="mb-5">
                            <label>Ảnh chi tiết sản phẩm 4:</label>
                            <br>
                            <input type="file" id="detailed_image_42" name="detailed_image_4" />
                            <br/>
                            <img src="{{\App\Library\Files::media(old('detailed_image_4', isset($data) ? $data->detailed_image_4 : null) )}}" class="mt-5" width="100px" height="150px" id="detailed_image_4" />
                        </div>
                        <div class="input-group m-input-group mb-5">
                            <label class="mb-3">Danh mục:</label>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                @if(isset($data))
                                    <select class="form-control" name="parent_id" id="">
                                        {!! getCategories($category, 0, "",$data['parent_id'] ) !!}
                                    </select>
                                @else
                                    <select class="form-control" name="parent_id" id="">
                                        {!! getCategories($category, 0, "", 0 ) !!}
                                    </select>
                                @endif
                            </div>
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
        <!-- END: Subheader -->
    </div>
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
        //
        document.getElementById("detailed_image_12").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("detailed_image_1").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);

        };
        document.getElementById("detailed_image_22").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("image_extension_2").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);

        };
        document.getElementById("detailed_image_32").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("detailed_image_3").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);

        };
        document.getElementById("detailed_image_42").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("detailed_image_4").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);

        };


        // $(document).ready(function (){
        //     $("#changeTitle").change(function (){
        //         if($(this).is(':checked')){
        //             $(".slug").removeAttr('disabled');
        //         }else{
        //             $(".slug").attr('disabled','');
        //         }
        //     });
        // });

    </script>
@stop
