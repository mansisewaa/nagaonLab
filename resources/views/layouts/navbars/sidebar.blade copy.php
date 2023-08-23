<style>
	.sidebar .nav {
		margin-top: 0 !important;
		display: block;
		overflow-y: scroll !important;
	}
</style>

<div class="sidebar" data-color="azure" data-background-color="lightslategray">
	<!--
	Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

				Tip 2: you can also add an image using data-image tag
				data-image="{{ asset('material') }}/img/sidebar-1.jpg"-->
	<div class="logo">
		<a href="" class="simple-text logo-normal">
			{{-- <h4> {{ auth::user()->lab_name }} </h4> --}}
			<h4>Health Care Labratory</h4>
		</a>
	</div>
	<div class="sidebar-wrapper">
		<ul class="nav">
			<li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('home') }}">
					<i class="material-icons">dashboard</i>
					<p>{{ __('Dashboard') }}</p>
				</a>
			</li>
			<li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('profile.edit') }}">
					<i class="material-icons">menu</i>
					<span class="sidebar-normal">{{ __('Profile') }} </span>
				</a>
			</li>
			@if (auth::user()->type == 'M')
			<li class="nav-item {{ $activePage == 'permissions' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('add-permissions') }}">
					<i class="material-icons">edit</i>
					<p>{{ __('Permissions') }}</p>
				</a>
			</li>
			@endif

			{{-- @if (auth::user()->coll_center == '1')
			<li class="nav-item {{ $activePage == 'collcenter' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('collcenter') }}">
					<i class="material-icons">content_paste</i>
					<p>{{ __('Collection Centers') }}</p>
				</a>
			</li>
			@endif --}}
			@if (auth::user()->investigations == '1')
			<li class="nav-item{{ $activePage == 'investigation' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('investigation') }}">
					<i class="material-icons">label</i>
					<p>{{ __('Investigations') }}</p>
				</a>
			</li>
			@endif
			{{-- @if (auth::user()->coll_agents == '1')
			<li class="nav-item{{ $activePage == 'collectionAgents' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('collectionAgents') }}">
					<i class="material-icons">person</i>
					<p>{{ __('Collection Agents') }}</p>
				</a>
			</li>
			@endif --}}

			<li class="nav-item{{ $activePage == 'materialorders' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('price.list.index') }}">
					<i class="material-icons">label</i>
					<p>{{ __('Material Orders') }}</p>
				</a>
			</li>



			@if (auth::user()->referrer == '1')
			<li class="nav-item{{ $activePage == 'referrer' ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('referrer') }}">
					<i class="material-icons">send</i>
					<p>{{ __('Referrer') }}</p>
				</a>
			</li>
			@endif

			<li class="nav-item">
				<a class="nav-link" href="{{ route('patientdetails') }}">
					<i class="material-icons">info</i>
					<p>{{ __('Case Details') }}</p>
				</a>
			</li>
			<li class="nav-item nav-dropdown">
				<a class="nav-link nav-dropdown-toggle" href="#">Reports<i class="material-icons"></i></a>
				<ul class="nav-dropdown-items">
					<li class="nav-item{{ $activePage == 'collections-report' ? ' active' : '' }}">
						<a class="nav-link" href="{{ route('collections-report') }}">
							<i class="material-icons">dehaze</i>
							<span class="sidebar-normal">{{ __('Collections Report') }} </span>
						</a>
					</li>
					<li class="nav-item{{ $activePage == 'test-count' ? ' active' : '' }}">
						<a class="nav-link" href="{{ route('test-count-report') }}">
							<i class="material-icons">dehaze</i>
							<span class="sidebar-normal">{{ __('Test Count') }} </span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
