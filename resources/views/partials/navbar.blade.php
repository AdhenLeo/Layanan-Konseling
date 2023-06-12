<nav class="h-16 shadow-sm bg-white flex sm:justify-end justify-between items-center align-middle px-5">
    <div class="sm:hidden block cursor-pointer" id="menu">
        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M4.7395 10.2083C4.7395 9.91826 4.85474 9.64006 5.05985 9.43495C5.26497 9.22983 5.54317 9.11459 5.83325 9.11459H29.1666C29.4567 9.11459 29.7349 9.22983 29.94 9.43495C30.1451 9.64006 30.2603 9.91826 30.2603 10.2083C30.2603 10.4984 30.1451 10.7766 29.94 10.9817C29.7349 11.1869 29.4567 11.3021 29.1666 11.3021H5.83325C5.54317 11.3021 5.26497 11.1869 5.05985 10.9817C4.85474 10.7766 4.7395 10.4984 4.7395 10.2083ZM4.7395 17.5C4.7395 17.2099 4.85474 16.9317 5.05985 16.7266C5.26497 16.5215 5.54317 16.4063 5.83325 16.4063H21.8749C22.165 16.4063 22.4432 16.5215 22.6483 16.7266C22.8534 16.9317 22.9687 17.2099 22.9687 17.5C22.9687 17.7901 22.8534 18.0683 22.6483 18.2734C22.4432 18.4785 22.165 18.5938 21.8749 18.5938H5.83325C5.54317 18.5938 5.26497 18.4785 5.05985 18.2734C4.85474 18.0683 4.7395 17.7901 4.7395 17.5ZM4.7395 24.7917C4.7395 24.5016 4.85474 24.2234 5.05985 24.0183C5.26497 23.8132 5.54317 23.6979 5.83325 23.6979H13.1249C13.415 23.6979 13.6932 23.8132 13.8983 24.0183C14.1034 24.2234 14.2187 24.5016 14.2187 24.7917C14.2187 25.0818 14.1034 25.36 13.8983 25.5651C13.6932 25.7702 13.415 25.8854 13.1249 25.8854H5.83325C5.54317 25.8854 5.26497 25.7702 5.05985 25.5651C4.85474 25.36 4.7395 25.0818 4.7395 24.7917Z"
                fill="black" />
        </svg>
    </div>
    <div class="flex items-center cursor-pointer" id="dropdown">
        <img src="{{ Auth::user()->profile != 'img/profile.png' ? asset('storage'.Auth::user()->profile) : asset(Auth::user()->profile) }}" alt="" class="w-11">
        <div class="ml-2">
            <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8201 8.37277L10.6402 13.5527L5.46033 8.37277" stroke="black" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>

    </div>
</nav>
<div class="hidden absolute flex flex-col gap-2 right-5 top-16 shadow-card rounded-lg w-48 z-10 p-3 bg-white" id="dropdown-card">
    <a href="{{ route('profile.index') }}">
        <p class="p-2 flex items-center gap-2 rounded-lg transition-colors hover:bg-primary hover:text-white"><span class="material-symbols-outlined">account_circle</span>Profile</p>
    </a>
    <div class="border-b border-non-active"></div>
    <form action="{{ route('auth.post.logout') }}" method="post">
        @csrf
        <button class="p-2 flex items-center gap-2 rounded-lg transition-colors hover:bg-primary hover:text-white w-full text-left"><span class="material-symbols-outlined">logout</span>Logout</button>
    </form>
</div>
