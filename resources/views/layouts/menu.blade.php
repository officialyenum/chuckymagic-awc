<!-- need to remove -->
    <li class="nav-item">
        <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Dashboard
            </p>
        </a>
    </li>
    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
        <li class="nav-item has-treeview menu-close">
            <a href='#' class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    User Management
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                    <i class="far nav-icon"></i>
                    <p>All Users</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far nav-icon"></i>
                    <p>Create Posts</p>
                </a>
                </li>
            </ul>
        </li>
    @endif
    <li class="nav-item has-treeview menu-close">
        <a href='#' class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
                Posts
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('posts.index')}}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>All Posts</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Create Posts</p>
            </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview menu-close">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
            Post Type
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>All Types</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Create Categories</p>
            </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview menu-close">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
            Post Features
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('tags.index')}}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>All Feature</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Create Categories</p>
            </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{route('trashed-posts.index')}}" class="nav-link">
            <i class="nav-icon fas fa-trash"></i>
            <p>
                Thrash
            </p>
        </a>
    </li>
