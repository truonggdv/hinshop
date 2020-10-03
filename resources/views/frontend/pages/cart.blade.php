@extends('frontend.layouts.index')
@section('title','Giỏ hàng')
@section('content')
<!-- Breadcrumb Begin -->

<script type="text/javascript">
    function update(qty,rowId){
        // console.log(qty);
        // console.log(rowId);
        $.get(
            '{{url('cart/update')}}',
            {qty:qty,rowId:rowId},
            function (){
                location.reload();
            }
        );
    }
</script>
    


<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
    <div class="container">
        @if(Cart::count() > 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="cart__product__item">
                                    <img width="120" height="130" src="{{\App\Library\Files::media( $item->options->image )}}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6> {{$item->name}} </h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">{{ number_format($item->price) }} VNĐ</td>
                                <td class="cart__quantity text-center">
                                        <input style="width: 40%" type="number" class="form-control input-number text-center" value="{{$item->qty}}" onchange="update(this.value,'{{$item->rowId}}')">
                                </td>
                                <td class="cart__total">{{ number_format($item->price*$item->qty) }} VNĐ</td>
                                <td class="cart__close">
                                    <form action="{{url('cart/delete'.'/'.$item->rowId)}}" method="post">
                                        {{csrf_field()}}
                                        <button style="border: none;" type="submit"><span class="icon_close"></span></button>
                                    </form>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="/">Tiếp tục mua sắm</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="{{url('cart/show')}}"><span class="icon_loading"></span> Cập nhật giỏ hàng</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Tổng giỏ hàng</h6>
                    <ul>
                        <li>Tổng tiền hàng <span>{{$total}} VNĐ</span></li>
                        <li>Tổng thanh toán <span>{{$total}} VNĐ</span></li>
                    </ul>
                    <a href="{{url('cart/cart-done')}}" class="primary-btn">Đặt hàng</a>
                    {{-- <form action="{{url('cart/cart-done')}}" method="post">
                        {{csrf_field()}}
                        <button style="border: none; width:100%" class="primary-btn" type="submit">Đặt hàng</button>
                    </form> --}}
                </div>
            </div>
        </div>
        @else
        <h5 class="text-center mb-5">Giỏ hàng rỗng</h5>
        <div class="cart__btn text-center">
            <a href="/">Bắt đầu mua sắm</a>
        </div>
        @endif
    </div>
    </section>
    <!-- Shop Cart Section End -->
    
    @stop