<div class="container-fluid db-top-bar">
    <div class="db-lims-logo">
        <div class="logo">
            <img src="{{ asset('storage/image/np.png') }}" alt="">
        </div>
        <p>Department of Food Technology <br> and Quality Control
        </p>
    </div>

    <a href="{{ route('profile') }}" class="db-top-bar-right @if(Auth::user()->role==3) d-none @endif">
        <div class="db-user-profile">
            <div class="usersmimage-div"> <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&rounded=true&background=FB802C&color=ffffff&size=28&bold=true"
                    alt=""></div>
            ​
            <div class="db-user-profile-right">
                <h3 class="username"> {{ Auth::user()->name }}</h3>
                <p class="userrole">
                    @if(Auth::user()->role==0)
                    Verifier
                    @elseif(Auth::user()->role==1)
                    Reviewer
                    @elseif(Auth::user()->role==2)
                    Data Entry Operator
                    @else
                    Report Viewer
                    @endif
                </p>
            </div>
        </div>
    </a>



    @if(Auth::user()->role==3)
    <div class="dropdown">
        <div class="db-user-profile" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="usersmimage-div"> <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&rounded=true&background=FB802C&color=ffffff&size=28&bold=true"
                    alt="">
            </div>
            ​
            <div class="db-user-profile-right">
                <h3 class="username"> {{ Auth::user()->name }}</h3>
                <p class="userrole">
                    @if(Auth::user()->role==0)
                    Verifier
                    @elseif(Auth::user()->role==1)
                    Reviewer
                    @elseif(Auth::user()->role==2)
                    Data Entry Operator
                    @else
                    Report Viewer
                    @endif
                </p>
            </div>
        </div>
        <ul class="dropdown-menu" style="padding: 20px;">
            <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">

                    <span class="material-symbols-outlined">logout</span>Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    @endif



</div>