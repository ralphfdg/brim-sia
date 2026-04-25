<nav style="background: #e0f2fe; padding: 15px; border-bottom: 2px solid #3b82f6;">
    <strong>Resident Navigation:</strong> 
    <a href="{{ route('dashboard') }}" style="margin-left: 15px; color: blue;">Dashboard</a>
    <form method="POST" action="{{ route('logout') }}" style="display: inline; float: right;">
        @csrf
        <button type="submit" style="background: none; border: none; color: blue; cursor: pointer;">Log Out</button>
    </form>
</nav>