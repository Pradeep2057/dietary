<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-column db-navbar">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('product.create') }}" id="add-sample"><i
                            class="fa-solid fa-plus"></i> Add Product </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('/')?  'active' : ' ' }} " href="{{ route('home') }}">
                        <span class="material-symbols-outlined">
                            dashboard
                        </span> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('product')|| Request::is('product/create') || Request::is('product/*/edit')?  'active' : ' ' }}"
                        href="{{ route('product.index') }}"><span class="material-symbols-outlined">
                            category
                        </span>
                        Products </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('report-view')?  'active' : ' ' }}"
                        href="{{ route('report-view') }}"><span class="material-symbols-outlined">
                            summarize
                        </span>
                        All Certificates </a>
                </li>

                <li class="nav-item accordion" id="Createcertificate">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <p class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#certificate-collapseTwo" aria-expanded="true"
                                aria-controls="certificate-collapseTwo">
                                <span class="material-symbols-outlined">
                                    new_window
                                </span>Create Certificate
                            </p>
                        </h2>
                        <div id="certificate-collapseTwo"
                            class="accordion-collapse collapse {{ Request::is('registration') || Request::is('registration/create') || Request::is('registration/*/edit') || Request::is('renewal') || Request::is('renewal/create')|| Request::is('renewal/*/edit') || Request::is('report') || Request::is('report/create') || Request::is('report/*/edit') || Request::is('renew')|| Request::is('renew/create')|| Request::is('renew/*/edit') ?  'show' : ' collapsed' }}">

                            <div class="accordion-body d-flex flex-column">
                                <a class="nav-link {{ Request::is('report') || Request::is('report/create') || Request::is('report/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('report.index') }}">Product Registration</a>
                                <a class="nav-link {{ Request::is('renew') || Request::is('renew/create')|| Request::is('renew/*/edit') ?  'active' : ' ' }}"
                                    href="{{ route('renew.index') }}">Product Renewal</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class=" nav-item accordion" id="productdetails">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <p class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#details-collapseOne" aria-expanded="false"
                                aria-controls="details-collapseOne">
                                <span class="material-symbols-outlined">
                                    page_info
                                </span> Product Details
                            </p>
                        </h2>
                        <div id="details-collapseOne"
                            class="accordion-collapse collapse {{ Request::is('type-of-product') || Request::is('type-of-product/create') || Request::is('type-of-product/*/edit') || Request::is('form-of-product') || Request::is('form-of-product/create') || Request::is('form-of-product/*/edit') || Request::is('dose') || Request::is('dose/create') || Request::is('dose/*/edit') || Request::is('size') || Request::is('size/create') || Request::is('size/*/edit') || Request::is('category') || Request::is('category/create') || Request::is('category/*/edit') || Request::is('nutrient-category') || Request::is('nutrient-category/create') || Request::is('nutrient-category/*/edit') || Request::is('nutrient') || Request::is('nutrient/create') || Request::is('nutrient/*/edit')|| Request::is('ingredient') || Request::is('ingredient/create') || Request::is('ingredient/*/edit') || Request::is('expirydate') || Request::is('expirydate/create') || Request::is('expirydate/*/edit')?  'show' : ' collapsed' }}">
                            <div class="accordion-body d-flex flex-column">
                                <a class="nav-link {{ Request::is('type-of-product') || Request::is('type-of-product/create') || Request::is('type-of-product/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('type-of-product.index') }}">Product Type</a>
                                <a class="nav-link {{ Request::is('form-of-product') || Request::is('form-of-product/create') || Request::is('form-of-product/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('form-of-product.index') }}">Product Form</a>
                                <a class="nav-link {{ Request::is('dose') || Request::is('dose/create') || Request::is('dose/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('dose.index') }}">Specified Dose</a>
                                <a class="nav-link {{ Request::is('size') || Request::is('size/create') || Request::is('size/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('size.index') }}">Size of Pack</a>
                                <a class="nav-link {{ Request::is('category') || Request::is('category/create') || Request::is('category/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('category.index') }}">Category</a>
                                <a class="nav-link {{ Request::is('nutrient-category') || Request::is('nutrient-category/create') || Request::is('nutrient-category/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('nutrient-category.index') }}">Nutrient Category</a>
                                <a class="nav-link {{ Request::is('nutrient') || Request::is('nutrient/create') || Request::is('nutrient/*/edit') ?  'active' : ' ' }}"
                                    href="{{ route('nutrient.index') }}">Nutrient</a>
                                <a class="nav-link {{ Request::is('ingredient') || Request::is('ingredient/create') || Request::is('ingredient/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('ingredient.index') }}">Ingredient</a>
                                <a class="nav-link {{ Request::is('expirydate') || Request::is('expirydate/create') || Request::is('expirydate/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('expirydate.index') }}">Expiry Date</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('importer')?  'active' : ' ' }}"
                        href="{{ route('importer.index') }}"><span class="material-symbols-outlined">
                            label_important
                        </span> Importer</a>
                </li>
                <li class=" nav-item accordion" id="manufacture">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <p class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#details-collapsefour" aria-expanded="false"
                                aria-controls="details-collapsefour">
                                <span class="material-symbols-outlined">
                                    factory
                                </span>Manufacture
                            </p>
                        </h2>
                        <div id="details-collapsefour"
                            class="accordion-collapse collapse {{ Request::is('manufacturer') || Request::is('manufacturer/create') || Request::is('manufacturer/*/edit') || Request::is('manufacturer-authority')|| Request::is('manufacturer-authority/create') || Request::is('manufacturer-authority/*/edit') || Request::is('capital') || Request::is('capital/create') || Request::is('capital/*/edit') || Request::is('country')|| Request::is('country/create') || Request::is('country/*/edit')?  'show' : ' collapsed' }}">
                            <div class="accordion-body d-flex flex-column">
                                <a class="nav-link {{ Request::is('manufacturer') || Request::is('manufacturer/create') || Request::is('manufacturer/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('manufacturer.index') }}">Manufacture</a>
                                <a class="nav-link {{ Request::is('manufacturer-authority') || Request::is('manufacturer-authority/create') || Request::is('manufacturer-authority/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('manufacturer-authority.index') }}">Manufacture
                                    Authority</a>
                                <a class="nav-link {{ Request::is('capital') || Request::is('capital/create') || Request::is('capital/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('capital.index') }}">Capital</a>
                                <a class="nav-link {{ Request::is('country') || Request::is('country/create') || Request::is('country/*/edit')?  'active' : ' ' }}"
                                    href="{{ route('country.index') }}">Country</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('lab')?  'active' : ' ' }}" href="{{ route('lab.index') }}"><span
                            class="material-symbols-outlined">
                            science
                        </span> Lab</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('agency')?  'active' : ' ' }}"
                        href="{{ route('agency.index') }}"><span class="material-symbols-outlined">
                            verified_user
                        </span>
                        Certifing Agency</a>
                </li>

                @if(Auth::user()->role==0)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('user') || Request::is('user/create')?  'active' : ' ' }}"
                        href="{{ route('user.index') }}"> <span class="material-symbols-outlined">
                                    person</span>Users</a>
                </li>
                @endif


                <!-- @if(Auth::user()->role==0)
                <li class="nav-item accordion" id="User">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <p class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#user-collapseThree" aria-expanded="false"
                                aria-controls="user-collapseThree">
                                <span class="material-symbols-outlined">
                                    person
                                </span>User
                            </p>
                        </h2>
                        <div id="user-collapseThree"
                            class="accordion-collapse collapse {{ Request::is('user/create') || Request::is('user')?  'show' : ' collapsed' }}">
                            <div class="accordion-body">
                                <a class="nav-link  {{ Request::is('user/create')?  'active' : ' ' }}"
                                    href="{{ route('user.create') }}">Add User</a>
                                <a class="nav-link  {{ Request::is('user')?  'active' : ' ' }}"
                                    href="{{ route('user.index') }}">User Table</a>
                            </div>
                        </div>
                    </div>
                </li>
                @endif -->

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                        <span class="material-symbols-outlined">logout</span>Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li> --}}


            </ul>
        </div>
    </div>
</nav>