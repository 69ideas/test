<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="/img/photo.png" class="user-image" alt="User Image"/>


        <span class="hidden-xs">{{ \Auth::user()->fio }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <p>
                {{ \Auth::user()->fio }}
                <br>
                <small>{{ \Auth::user()->role_name }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-right">
                <a href="/logout" class="btn btn-default btn-flat">Log out</a>
            </div>
        </li>
    </ul>
</li>