<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
            </div>
            <div class="pull-left info">
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li class="treeview {{ $active_users or '' }}">
                <a href="{{ route('admin.user.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="treeview {{ $active_articles or '' }}">
                <a href="{{ route('admin.article.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span>Blog</span>
                </a>
            </li>
            <li class="treeview {{ $active_pages or '' }}">
                <a href="{{ route('admin.page.index') }}">
                    <i class="fa fa-files-o"></i>
                    <span>Manage Pages</span>
                </a>
            </li>
            <li class="treeview {{ $active_events or '' }}">
                <a href="{{ route('admin.event.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>Manage Events</span>
                </a>
            </li>
            <li class="treeview {{ $active_menu or '' }}">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>Customisation</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ $open_menu or '' }}">
                    <li class="treeview {{ $active_faqs or '' }}">
                        <a href="{{ route('admin.faq.index') }}">
                            <i class="fa fa-question"></i> <span>FAQ</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
