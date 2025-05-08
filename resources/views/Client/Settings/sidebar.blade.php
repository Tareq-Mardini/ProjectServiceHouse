<ul style="margin-top:0px" class="side-menu top">
    <li>
        <a href="{{route('Client.View.Account')}}">
            <i class='bx bx-user'></i>
            <span class="text">My Account</span>
        </a>
    </li>

    <ul>
        <li>
            <a href="{{route('view.chat.Suppliers')}}">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Messages</span>
            </a>
        </li>
        <li>
            <a href="{{route('view.communication')}}">
                <i class='bx bxs-phone'></i>
                <span class="text">Customer Service</span>
            </a>
        </li>
        <li>
            <a href="{{route('View.wallet.clinet')}}">
                <i class='bx bx-wallet'></i>
                <span class="text">My Wallet</span>
            </a>
        </li>
        <li>
            <a href="{{route('View.Order.clinet')}}">
                <i class='bx bxs-cart'></i>
                <span class="text">My Orders</span>
            </a>
        </li>
        <li>
            <a href="{{route('ViewFavorite')}}">
                <i class='bx bxs-heart'></i>
                <span class="text">My Favourites</span>
            </a>
        </li>
    </ul>

    <li>
        <a href="{{route('Logout.client')}}" class="logout">
            <i class='bx bxs-log-out-circle'></i>
            <span class="text">Logout</span>
        </a>
    </li>
</ul>