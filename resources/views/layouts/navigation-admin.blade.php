<nav style="background: #fee2e2; padding: 15px; border-bottom: 2px solid #ef4444;">
    <strong>Secretary Navigation:</strong> 
    <a href="{{ route('dashboard') }}" style="margin-left: 15px; color: red;">Admin Panel</a>
    <form method="POST" action="{{ route('logout') }}" style="display: inline; float: right;">
        @csrf
        <button type="submit" style="background: none; border: none; color: blue; cursor: pointer;">Log Out</button>
    </form>
</nav>