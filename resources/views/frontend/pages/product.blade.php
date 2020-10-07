@extends('frontend.layouts.index')
@section('title','Sản phẩm')
@section('content')

    <!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href=" {{ url('/') }} "><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Sản phẩm</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Danh mục sản phẩm</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                        <div class="card-body">
                                            <ul>
                                                @foreach($category as $cat)
                                                <li><a href="{{url('danh-muc/'.$cat->slug)}}"> {{$cat->name}} </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>Theo giá</h4>
                        </div>
                        <div class="filter-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                 data-min="33" data-max="99"></div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <p>Giá:</p>
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                        <a href="#">Lọc</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
            <div class="section-title">
                <h4>Sản phẩm nổi bật</h4>
            </div>
                <div class="row">
                    @foreach($highlights as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}">
                                <div class="label new">Nổi bật</div>
                                <ul class="product__hover">
                                    <li><a href="{{\App\Library\Files::media( $item->image )}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="{{url('san-pham/'.$item->slug)}}"><span class="far fa-eye"></span></a></li>
                                    <li><a href="{{url('cart/add'.'/'.$item->id)}}"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{url('san-pham/'.$item->slug)}}">{{$item->title}}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">{{ number_format($item->price) }}  VNĐ</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12 text-center">
                        <div class="pagination__option">
                            <button type="submit" class="site-btn">Xem thêm</button>
                        </div>
                    </div>
                </div>
{{--            --}}
                <div style="margin-top: 10%" class="section-title">
                    <h4>Bán chạy</h4>
                </div>
                <div class="row">
                    @foreach($selling as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{\App\Library\Files::media( $item->image )}}">
                                    @if(isset($item->sale))
                                        <div class="label sale">Giảm giá</div>
                                        @else
                                        <div style="background: #e3c01c" class="label">Nổi bật</div>
                                        @endif
                                    <ul class="product__hover">
                                        <li><a href="{{\App\Library\Files::media( $item->image )}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="{{url('san-pham/'.$item->slug)}}"><span class="far fa-eye"></span></a></li>
                                        <li><a href="{{url('cart/add'.'/'.$item->id)}}"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{url('san-pham/'.$item->slug)}}">{{$item->title}}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">{{ number_format($item->price) }}  VNĐ</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12 text-center">
                        <div class="pagination__option">
                            <button type="submit" class="site-btn">Xem thêm</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Shop Section End -->
    @stop

