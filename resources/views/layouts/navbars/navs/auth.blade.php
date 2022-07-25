<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
	<div class="container-fluid">
		<div class="navbar-wrapper">
			<a class="navbar-brand" href="#"></a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="sr-only">Toggle navigation</span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end">
			{{-- <form class="navbar-form">
        <div class="input-group no-border">
        <input type="text" value="" class="form-control" placeholder="Search...">

        </div>
      </form> --}}
      <ul class="navbar-nav">
			@if (auth()->user()->type == 'CC')
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="material-icons">wallet</i>{{ __('Wallet') }}</a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        {{-- <a class="dropdown-item" href="">{{ __('Profile') }}</a> --}}
                        @php
                            $wallet = DB::table('users')->where('id', auth()->user()->id)->value('wallet_balance');
                        @endphp
                        <a class="dropdown-item" href="#">
                            Rs {{$wallet}}
                        </a>
                    </div>
                </li>
			@endif

			<li class="nav-item dropdown">
				<a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">
					<i class="material-icons">person</i>{{ auth::user()->name }}

				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
					{{-- <a class="dropdown-item" href="">{{ __('Profile') }}</a> --}}
					@if(auth()->user()->type == "CC")
                    <a class="dropdown-item" href="{{ route('recharge-wallet') }}">Recharge Wallet</a>
                    @endif

					<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>

					<form id="logout-form" class="d-none" method="POST" action="{{ route('logout') }}">
						@csrf
					</form>

				</div>
			</li>
			</ul>
		</div>
	</div>
</nav>
