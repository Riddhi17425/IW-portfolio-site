<!-- sidebar -->
<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{{ route('admin.dashboard') }}" class="mb-0 brand-icon">
            <span class="logo-icon">
                <i class="icofont-bag-alt fs-4"></i>
            </span>
            <span class="logo-text">Iw Portfolio</span>
        </a>

        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">

            <!-- Dashboard -->
            <li>
                <a class="m-link{{ Request::routeIs('admin.dashboard') ? ' active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                   <i class="icofont-home fs-5"></i>
                   <span>Dashboard</span>
                </a>
            </li>

            <!-- Product Management -->
            <li class="collapsed{{ Request::routeIs('category.*') || Request::routeIs('product.*') ||
            Request::routeIs('industry.*') || Request::routeIs('tabing.*') || Request::routeIs('clothsize.*') || Request::routeIs('clothcolor.*') || Request::routeIs('portfolio.*') ? ' active' : '' }}">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-product-management"
                 href="#">
                    <i class="icofont-box fs-5"></i>
                    <span>Project Management</span>
                    <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span>
                </a>
                <ul class="sub-menu collapse{{ Request::routeIs('category.*') ||Request::routeIs('product.*') || Request::routeIs('industry.*') || Request::routeIs('tabing.*') || Request::routeIs('brand.*') || Request::routeIs('clothsize.*') || Request::routeIs('clothcolor.*') || Request::routeIs('portfolio.*') ? ' show' : '' }}" id="menu-product-management">

                    <!-- Category -->
                    <li>
                        <a class="m-link{{ Request::routeIs('category.index') ? ' active' : '' }}" href="{{ route('category.index') }}">
                           <i class="icofont-tags fs-5"></i>
                           <span>Category</span>
                        </a>
                    </li>

                    <!-- Product -->
                    <!--<li>-->
                    <!--    <a class="m-link{{ Request::routeIs('product.index') ? ' active' : '' }}" href="{{ route('product.index') }}">-->
                    <!--       <i class="icofont-box fs-5"></i>-->
                    <!--       <span>Project</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!-- Brand -->
                    <li>
                        <a class="m-link{{ Request::routeIs('industry.index') ? ' active' : '' }}" href="{{ route('industry.index') }}">
                           <i class="icofont-crown fs-5"></i>
                           <span>Industry</span>
                        </a>
                    </li>

                    <li>
                        <a class="m-link{{ Request::routeIs('tabing.index') ? ' active' : '' }}" href="{{ route('tabing.index') }}">
                           <i class="icofont-list fs-5"></i>
                           <span>Tabing</span>
                        </a>
                    </li>

                    <!-- Portfolio -->
                    <li>
                        <a class="m-link{{ Request::routeIs('portfolio.*') ? ' active' : '' }}" href="{{ route('portfolio.index') }}">
                           <i class="icofont-layout fs-5"></i>
                           <span>Projects</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>
