<div class="container-fluid">
    <div class="seperate"></div>
    <div class="row">
        <div class="col-xs-2 col-xs-offset-1">
            <a href="{{ url('/') }}">
                <img src="/images/logo.png" class="homely-logo" alt="homely logo">
            </a>
        </div>
        <div class="col-xs-9">
            <div class="seperate"></div>
            <ul class="homely-navbar">
                <li><a class="" href="{{ url('/admin/chat') }}">
                    <i class="fa fa-chat"></i>
                </a></li>
                <li><a class="" href="{{ url('/admin/notification') }}">
                    <i class="fa fa-bell"></i>
                </a></li>
                <li><a class="" href="{{ url('/admin/search') }}">
                    <i class="fa fa-search"></i>
                </a></li>
                <li><a href="">
                    <img class="img-circle" src="{{ asset('/images/profile-picture.png') }}" alt="profile picture">
                </a></li>
            </ul>
        </div>
    </div>
</div>