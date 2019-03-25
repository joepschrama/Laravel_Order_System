<nav class="nav">
    <ul class="nav__list">
        <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('home') ? 'active' : '') }}" href="/">Home</a></li>
        <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('role*') ? 'active' : '') }}" href="/role">Roles</a></li>
        <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('user*') ? 'active' : '') }}" href="/user">Users</a></li>
        <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('category*') ? 'active' : '') }}" href="/category">Categories</a></li>
        <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('product*') ? 'active' : '') }}" href="/product">Products</a></li>
    </ul>
</nav>