<nav class="nav">
    <ul class="nav__list">
        <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('home') ? 'active' : '') }}" href="/">Home</a></li>
        @if (Auth::User()->hasRole('ober'))
            <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('order*') ? 'active' : '') }}" href="/order">Orders ober</a></li>
        @elseif (Auth::User()->hasRole('kok'))
            <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('order*') ? 'active' : '') }}" href="/order">Orders Kok</a></li>
        @elseif (Auth::User()->hasRole('bar'))
            <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('order*') ? 'active' : '') }}" href="/order">Orders Bar</a></li>
        @else
            <li class="nav__list-item"><a class="nav__list-link {{ (Request::is('order*') ? 'active' : '') }}" href="/order">Orders</a></li>
            <li class="nav__list-item nav__list-link nav__dropdown">
                <a class="nav__dropdown-item {{ (Request::is('category*', 'product*', 'table*', 'role*', 'user*') ? 'active' : '') }}">Gegevens</a>
                <div class="nav__dropdown-content">
                    <a class="nav__list-link {{ (Request::is('category*') ? 'active' : '') }}" href="/category">Categories</a>
                    <a class="nav__list-link {{ (Request::is('product*') ? 'active' : '') }}" href="/product">Products</a>
                    <a class="nav__list-link {{ (Request::is('table*') ? 'active' : '') }}" href="/table">Tables</a>
                    <a class="nav__list-link {{ (Request::is('role*') ? 'active' : '') }}" href="/role">Roles</a>
                    <a class="nav__list-link {{ (Request::is('user*') ? 'active' : '') }}" href="/user">Users</a>
                </div>
            </li>
        @endif
        <li class="nav__list-item" ><a class="nav__list-link" href="/logout" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
            <form id="logout-form" action="http://localhost:8000/logout" method="POST" style="display: none;">@csrf</form>
        </li>
    </ul>
</nav>
<script>
// let dropdown = document.querySelector('.nav__dropdown');
let dropdownContent = document.querySelector('.nav__dropdown-content');
let closed = true;

if(dropdownContent) {
    window.onclick = function(event){
        if(event.target.matches('.nav__dropdown') || event.target.matches('.nav__dropdown-item')) {
            dropdownContent.classList.remove('nav__dropdown-content');
            dropdownContent.classList.add('nav__dropdown-content--active');
        } else {
            dropdownContent.classList.remove('nav__dropdown-content--active');
            dropdownContent.classList.add('nav__dropdown-content');
        }
    };
}

</script>
