<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <h5><a class="text-center" style="color: #fff; font-family: 'Roboto', sans-serif" href=" {{url('/admin/dashboard')}} ">Hin Shop</a></h5>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>

                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                <!-- BEGIN: Horizontal Menu -->


                <!-- END: Horizontal Menu -->

                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-topbar__languages m-dropdown m-dropdown--small m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width" m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-text">
<!--                                                    --><?php
//                                                        dd($language_active);
//                                                    ?>
													<img height="28" class="m-topbar__language-selected-img" src="{{\App\Library\Files::media( $language_active->image)}}">
												</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
                                            <span class="m-dropdown__header-subtitle">Thay đổi ngôn ngữ</span>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
{{--                                                    <li class="m-nav__item m-nav__item--active">--}}
{{--                                                        <a href="#" class="m-nav__link m-nav__link--active">--}}
{{--                                                            <span class="m-nav__link-icon"><img class="m-topbar__language-img" src="assets/app/media/img/flags/020-flag.svg"></span>--}}
{{--                                                            <span class="m-nav__link-title m-topbar__language-text m-nav__link-text">USA</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
                                                    @foreach($language as $la)
                                                    <li class="m-nav__item">
                                                        <a href="{{route('locale.index',[$la->locale])}}" class="m-nav__link">
                                                            <span class="m-nav__link-icon"><img width="30" height="25" class="m-topbar__language-img" src="{{\App\Library\Files::media( $la->image)}}"></span>
                                                            <span class="m-nav__link-title m-topbar__language-text m-nav__link-text">{{$la->title}}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @guest
                            @else
                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />
{{--                                                    <img src="{{\App\Library\Files::media( Auth::user()->image)}}" class="m--img-rounded m--marginless" alt="" />--}}
												</span>
                                    <span class="m-topbar__username m--hide">Nick</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />

                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500"> {{ Auth::user()->name }}</span>
                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link"> {{ Auth::user()->email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">Section</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('user.edit',[Auth::user()->id])}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">Thông tin</span>
																				<span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
																			</span>
																		</span>
                                                        </a>
                                                    </li>
{{--                                                    <li class="m-nav__item">--}}
{{--                                                        <a href="header/profile.html" class="m-nav__link">--}}
{{--                                                            <i class="m-nav__link-icon flaticon-share"></i>--}}
{{--                                                            <span class="m-nav__link-text">Hoạt động</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="m-nav__item">--}}
{{--                                                        <a href="header/profile.html" class="m-nav__link">--}}
{{--                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>--}}
{{--                                                            <span class="m-nav__link-text">Tin nhắn</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="m-nav__separator m-nav__separator--fit">--}}
{{--                                                    </li>--}}
{{--                                                    <li class="m-nav__item">--}}
{{--                                                        <a href="header/profile.html" class="m-nav__link">--}}
{{--                                                            <i class="m-nav__link-icon flaticon-info"></i>--}}
{{--                                                            <span class="m-nav__link-text">FAQ</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="m-nav__item">--}}
{{--                                                        <a href="header/profile.html" class="m-nav__link">--}}
{{--                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>--}}
{{--                                                            <span class="m-nav__link-text">Hỗ trợ</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="m-nav__separator m-nav__separator--fit">--}}
{{--                                                    </li>--}}
                                                    <li class="m-nav__item">
{{--                                                        <a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Đăng xuất</a>--}}
                                                        <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            Đăng xuất
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>
