<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Wisata Web App</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Ws</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item  ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('users.index') }}" class="nav-link "><i class="fa-solid fa-users"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('categories.index') }}" class="nav-link "><i class="fa-solid fa-list"></i>
                    <span>Categories</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('products.index') }}" class="nav-link "><i class="fa-solid fa-ticket"></i>
                    <span>Products</span></a>
            </li>
    </aside>
</div>
