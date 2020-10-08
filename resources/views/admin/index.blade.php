@extends('admin.layouts.index')
@section('title','Trang chủ quản trị')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Trang chủ quản trị</h3>
            </div>
            <div>
                <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                    <span class="m-subheader__daterange-label">
                        <span class="m-subheader__daterange-title"></span>
                        <span class="m-subheader__daterange-date m--font-brand"></span>
                    </span>
                </span>
            </div>
        </div>
    </div>

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    Đơn hàng
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget17">
                            <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
                                <div class="m-widget17__chart" style="height:320px;">
                                    <canvas id="m_chart_activities"></canvas>
                                </div>
                            </div>
                            <div class="m-widget17__stats">
                                <div class="m-widget17__items m-widget17__items-col1">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-truck m--font-brand"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Ngày hôm nay
														</span>
                                        <span class="m-widget17__desc">
                                                            {{$count1}} Đơn hàng
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-paper-plane m--font-info"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Doanh thu ngày
														</span>
                                        <span class="m-widget17__desc">
                                                            {{number_format($sum1)}} VNĐ
														</span>
                                    </div>
                                </div>
                                <div class="m-widget17__items m-widget17__items-col2">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-pie-chart m--font-success"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Tháng này
														</span>
                                        <span class="m-widget17__desc">
                                                            {{$count}} Đơn hàng
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-time m--font-danger"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Doanh thu tháng
														</span>
                                        <span class="m-widget17__desc">
                                                            {{number_format($sum)}} VNĐ
														</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Xử lí đơn hàng
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <!--begin::Widget5-->
                        <div class="m-widget4">
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20" style="height:260px;">
                                <canvas id="m_chart_trends_stats"></canvas>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo3.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Chưa xử lí
													</span><br>
                                    <span class="m-widget4__sub">Tháng {{ $month }} </span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger"> {{$order}}</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo1.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Đã xử lí
													</span><br>
                                    <span class="m-widget4__sub">
														Tháng {{$month}}
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger"> {{$order_r}} </span>
												</span>
                            </div>
                            {{-- <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="assets/app/media/img/client-logos/logo2.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Quần Nam
													</span><br>
                                    <span class="m-widget4__sub">
														50 Sản phẩm
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">+8.000.000 (VNĐ)</span>
												</span>
                            </div> --}}
                        </div>

                        <!--end::Widget 5-->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
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
                                        Sản phẩm
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content" role="tab">
                                        Bài viết
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
                                    <div style="overflow-y: scroll; height:450px" class="m-timeline-3__items">
                                        @foreach($product as $key => $item)
                                        <div class="m-timeline-3__item m-timeline-3__item--info">
                                            <span class="m-timeline-3__item-time">{{date('H:i', strtotime($item->updated_at))}}</span>
                                            <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	{{$item->author}} đã thêm một sản phẩm
																</span><br>
                                                <span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		{{$item->title}}
																	</a>
																</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!--End::Timeline 3 -->
                            </div>
                            <div class="tab-pane" id="m_widget2_tab2_content">

                                <!--Begin::Timeline 3 -->
                                <div class="m-timeline-3">
                                    <div style="overflow-y: scroll; height:450px" class="m-timeline-3__items">
                                        @foreach($news as $item)
                                        <div class="m-timeline-3__item m-timeline-3__item--danger">
                                            <span class="m-timeline-3__item-time m--font-warning">{{date('H:i', strtotime($item->updated_at))}}</span>
                                            <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	{{$item->author}} đã thêm một bài viết
																</span><br>
                                                <span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		{{$item->title}}
																	</a>
																</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!--End::Timeline 3 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-action">
                                <button style="font-family: 'Roboto', sans-serif" type="button" class="btn btn-sm m-btn--pill  btn-brand">Bài đăng mới nhất</button>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                                <img src="{{\App\Library\Files::media( $new->image_extension )}}" alt="">
                                <h3 class="m-widget19__title m--font-light">
                                    {{ $new->title }}
                                </h3>
                                <div class="m-widget19__shadow"></div>
                            </div>
                            <div class="m-widget19__content">
                                <div class="m-widget19__header">
                                    <div class="m-widget19__user-img">
                                        <img class="m-widget19__img" src="assets/app/media/img//users/user1.jpg" alt="">
                                    </div>
                                    <div class="m-widget19__info">
														<span class="m-widget19__username">
															{{$new->author}}
														</span><br>
                                        <span class="m-widget19__time">
                                                    {{date('H:i', strtotime($new->updated_at))}}
														</span>
                                    </div>
                                    <div class="m-widget19__stats">
														<span class="m-widget19__number m--font-brand">
															{{date('d', strtotime($new->updated_at))}}
														</span>
                                        <span style="margin-left: -20px" class="m-widget19__comment">
                                                            Tháng <p style="margin-left: 50px">{{date('m', strtotime($new->updated_at))}}</p>
														</span>
                                    </div>
                                </div>
                                <div class="m-widget19__body">
                                   {!! $new->description !!}
                                </div>
                            </div>
                            <div class="m-widget19__action">
                                <a target="_blank" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom" href="{{url('blog/bai-viet/'.$new->slug)}}">Xem bài viết</a>
                                {{-- <button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">Xem bài viết</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
