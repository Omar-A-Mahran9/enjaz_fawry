<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
    m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;direction:ltr;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        {{-- <li class="m-menu__item @if (itemIsActive('dashboard', 'home')) {{'m-menu__item--active'}} @endif" aria-haspopup="true"><a href="{{ route('dashboard.home') }}" class="m-menu__link "><i class="m-menu__link-icon fa fa-home"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">الرئسية</span>
            </span></span></a></li> --}}

        <li class="m-menu__section">
            <h4 class="m-menu__section-text">الطلبات</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>
        {{-- @if ($new_mo3amla > 0) <span class="notifyCount">{{ $new_mo3amla  }}</span> @endif --}}
        <li class="m-menu__item @if (itemIsActive('mo3amla', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.order.mo3amla.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-inbox"></i><span class="m-menu__link-text">المعاملات</span></a></li>
        <li class="m-menu__item @if (itemIsActive('ta3med', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.order.ta3med.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-puzzle-piece"></i><span class="m-menu__link-text">التعميد</span></a>
        </li>
        <li class="m-menu__item @if (itemIsActive('estfsar', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.order.estfsar.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-info-circle"></i><span class="m-menu__link-text">الاستفسار</span></a>
        </li>
        <li class="m-menu__item @if (itemIsActive('company', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.order.company.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-suitcase"></i><span class="m-menu__link-text">الشركات</span></a></li>
        <li class="m-menu__item @if (itemIsActive('guarante', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.order.guarante.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-suitcase"></i><span class="m-menu__link-text">ضمان مبلغ
                    سلعة</span></a></li>


        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">الخدمات</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>

        {{-- @if (auth()->user()->hasAnyPermission(['cars_edite', 'cars_create', 'cars_index', 'cars_delete', 'cars', 'color_edite', 'color_create', 'color_index', 'color_delete', 'color'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('product')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('color')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif "
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-cogs"></i><span
                    class="m-menu__link-text">الخدمات</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item @if (itemIsActive('service', 'create')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.service.create') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">اضافة خدمة</span></a></li>
                    <li class="m-menu__item @if (itemIsActive('service', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.service.index') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">جميع الخدمات</span></a></li>
                    {{-- <li class="m-menu__item @if (itemIsActive('sub_service', 'create')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.sub_service.create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">اضافة خدمة فرعية</span></a></li> --}}
                    {{-- <li class="m-menu__item @if (itemIsActive('product', 'index')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.product.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">جميع السيارات</span></a></li>
                                <li class="m-menu__item @if (itemIsActive('color', 'create')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.color.create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">اضافة لون</span></a></li>
                                <li class="m-menu__item @if (itemIsActive('color', 'index')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.color.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">جميع الالوان</span></a></li> --}}

                </ul>
            </div>
        </li>

        <li class="m-menu__item  m-menu__item--submenu @if (isActive('contact')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('color')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif "
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-phone"></i><span
                    class="m-menu__link-text">خدمة التواصل</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item @if (itemIsActive('contact', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.contact_order.All') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">طلبات التواصل</span></a></li>
                    <li class="m-menu__item @if (itemIsActive('contact', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.contact_order.service', ['id' => 54]) }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text"> خدمات الجوازات
                            </span></a></li>

                    <li class="m-menu__item @if (itemIsActive('contact', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.contact_order.service', ['id' => 56]) }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">خدمات وزارة التجارة

                            </span></a></li>

                    <li class="m-menu__item @if (itemIsActive('contact', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.contact_order.service', ['id' => 66]) }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">خدمات الـمرور
                            </span></a></li>

                    <li class="m-menu__item @if (itemIsActive('contact', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.contact_order.service', ['id' => 68]) }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">خدمات الـمساند

                            </span></a></li>
                    {{-- <li class="m-menu__item @if (itemIsActive('sub_service', 'create')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.sub_service.create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">اضافة خدمة فرعية</span></a></li> --}}
                    {{-- <li class="m-menu__item @if (itemIsActive('product', 'index')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.product.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">جميع السيارات</span></a></li>
                                <li class="m-menu__item @if (itemIsActive('color', 'create')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.color.create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">اضافة لون</span></a></li>
                                <li class="m-menu__item @if (itemIsActive('color', 'index')) {{'m-menu__item--active'}}@endif" aria-haspopup="true"><a href="{{ route('dashboard.color.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">جميع الالوان</span></a></li> --}}

                </ul>
            </div>
        </li>
        {{-- @endif --}}

        <li class="m-menu__section">
            <h4 class="m-menu__section-text">العملاء</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>

        <li class="m-menu__item @if (itemIsActive('clients', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.clients.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-user-circle"></i><span class="m-menu__link-text">العملاء</span></a>
        </li>
        <li class="m-menu__item @if (itemIsActive('vendors', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.vendors.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-id-card"></i><span class="m-menu__link-text">معقبين / مكاتب
                    الخدمات</span></a></li>
        <li class="m-menu__item @if (itemIsActive('blacklist', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.blacklist.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-ban"></i><span class="m-menu__link-text">القائمة السوداء</span></a>
        </li>




        <li class="m-menu__section">
            <h4 class="m-menu__section-text">التواصل والتقييمات</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>

        <li class="m-menu__item @if (itemIsActive('contact', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.contact.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-envelope"></i><span class="m-menu__link-text">التواصل</span></a>
        </li>
        <li class="m-menu__item @if (itemIsActive('reviews', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.reviews.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-star"></i><span class="m-menu__link-text">تقييم المعقبين
                </span></a></li>
        <li class="m-menu__item @if (itemIsActive('site_review', 'index')) {{ 'm-menu__item--active' }} @endif"
            aria-haspopup="true"><a href="{{ route('dashboard.site_review.index') }}" class="m-menu__link "><i
                    class="m-menu__link-icon fa fa-certificate"></i><span class="m-menu__link-text">تقييم انجاز فوري
                </span></a></li>


        {{-- <li class="m-menu__section ">
                <h4 class="m-menu__section-text">عام</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li> --}}
        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">ادارة الموقع</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>

        {{-- @if (auth()->user()->hasAnyPermission(['cities_edite', 'cities_create', 'cities_index', 'cities_delete', 'cities'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('cities')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif"
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-map-marked-alt"></i><span
                    class="m-menu__link-text">المدن</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    <li class="m-menu__item @if (itemIsActive('cities', 'create')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.cities.create') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">اضافة مدن</span></a></li>
                    <li class="m-menu__item @if (itemIsActive('cities', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.cities.index') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">جميع المدن</span></a></li>
                </ul>
            </div>
        </li>
        {{-- @endif --}}
        {{-- @if (auth()->user()->hasAnyPermission(['banks_edite', 'banks_create', 'banks_index', 'banks_delete', 'banks'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('banks')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif"
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fab fa-cc-visa"></i><span
                    class="m-menu__link-text">البنوك</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    {{-- @if (auth()->user()->hasAnyPermission(['banks_create'])) --}}
                    <li class="m-menu__item @if (itemIsActive('banks', 'create')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.banks.create') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">اضافة بنك</span></a></li>
                    {{-- @endif --}}
                    {{-- @if (auth()->user()->hasAnyPermission(['banks_index'])) --}}
                    <li class="m-menu__item @if (itemIsActive('banks', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.banks.index') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">جميع البنوك</span></a></li>
                    {{-- @endif --}}
                </ul>
            </div>
        </li>
        {{-- @endif --}}




        {{-- @if (auth()->user()->hasAnyPermission(['status_edite', 'status_create', 'status_index', 'status_delete', 'status'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('status')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif"
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-check-double"></i><span
                    class="m-menu__link-text">الحالات</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    {{-- @if (auth()->user()->hasAnyPermission(['status_create']))  --}}
                    <li class="m-menu__item @if (itemIsActive('status', 'create')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.status.create') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">انشاء حالة</span></a></li>
                    {{-- @endif
                            @if (auth()->user()->hasAnyPermission(['status_index']))  --}}
                    <li class="m-menu__item @if (itemIsActive('status', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.status.index') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">جميع الحالات</span></a></li>
                    {{-- @endif --}}
                </ul>
            </div>
        </li>
        {{-- @endif --}}





        {{-- @if (auth()->user()->hasAnyPermission(['blog', 'blog_index', 'blog_edite', 'blog_create', 'blog_delete'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('blog')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif "
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fab fa-blogger"></i><span
                    class="m-menu__link-text">المدونة</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    {{-- @if (auth()->user()->hasAnyPermission(['blog_create']))  --}}
                    <li class="m-menu__item @if (itemIsActive('blog', 'create')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.blog.create') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">اضافة تدوينة</span></a></li>

                    {{-- @endif
                            @if (auth()->user()->hasAnyPermission(['blog_index']))  --}}
                    <li class="m-menu__item @if (itemIsActive('blog', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.blog.index') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">جميع التدوينات</span></a></li>

                    {{-- @endif --}}
                </ul>
            </div>
        </li>
        {{-- @endif --}}




        {{-- @if (auth()->user()->hasAnyPermission(['questions_edite', 'questions_create', 'questions_index', 'questions_delete', 'questions'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('common_questions')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif "
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fab fa-readme"></i><span
                    class="m-menu__link-text">الأسئلة الشائعة</span><i
                    class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    {{-- @if (auth()->user()->hasAnyPermission(['questions_create'])) 
                                <li class="m-menu__item @if (itemIsActive('common_questions', 'create')) {{'m-menu__item--active'}} @endif" aria-haspopup="true"><a href="{{ route('dashboard.common_questions.create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">اضافة سؤال</span></a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['questions_index']))  --}}
                    <li class="m-menu__item @if (itemIsActive('common_questions', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.common_questions.index') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">جميع الأسئلة</span></a></li>
                    {{-- @endif     --}}
                </ul>
            </div>
        </li>
        {{-- @endif --}}

        {{-- @if (auth()->user()->hasAnyPermission(['questions_edite', 'questions_create', 'questions_index', 'questions_delete', 'questions'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('setting')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('HomeEdit')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('whysaleh')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('GetRefundAndPolicy')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif"
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-sliders-h"></i><span
                    class="m-menu__link-text">الاعدادات</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item @if (itemIsActive('setting', 'edit')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.setting.edit') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">الاعدادات العامة</span></a></li>
                    <li class="m-menu__item @if (itemIsActive('dashboard', 'HomeEdit')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.HomeEdit') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">واجهة الموقع</span></a></li>
                    <li class="m-menu__item @if (itemIsActive('dashboard', 'termsGet')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.termsGet') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">الشروط والاحكام</span></a></li>
                </ul>
            </div>
        </li>
        {{-- @endif --}}

        {{-- @if (auth()->user()->hasAnyPermission(['questions_edite', 'questions_create', 'questions_index', 'questions_delete', 'questions'])) --}}
        <li class="m-menu__item  m-menu__item--submenu @if (isActive('setting')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('HomeEdit')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('whysaleh')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif @if (isActive('GetRefundAndPolicy')) {{ 'm-menu__item--open m-menu__item--expanded' }} @endif"
            aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-university"></i><span
                    class="m-menu__link-text">الحسابات</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item @if (itemIsActive('accounts', 'index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.accounts.index') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">الشاشة الرئسية</span></a></li>
                    <li class="m-menu__item @if (itemIsActive('accounts', 'balance.index')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.accounts.withdraw.index') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">طلبات المسحوبات </span></a></li>
                    <li class="m-menu__item @if (itemIsActive('dashboard', 'termsGet')) {{ 'm-menu__item--active' }} @endif"
                        aria-haspopup="true"><a href="{{ route('dashboard.accounts.balance.index') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">ارصدة المعقبين</span></a></li>
                    {{-- <li class="m-menu__item @if (itemIsActive('dashboard', 'termsGet')) {{'m-menu__item--active'}} @endif" aria-haspopup="true"><a href="{{ route('dashboard.accounts.statement.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">كشف حساب</span></a></li> --}}
                </ul>
            </div>
        </li>
        {{-- @endif --}}

    </ul>
</div>
