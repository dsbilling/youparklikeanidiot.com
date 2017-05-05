<ul class="nav nav-pills nav-stacked">
	<li @if(Request::is('account')) class="active" @endif><a href="{{ route('account') }}"><span class="fa fa-leaf"></span> My account</a></li>
	<li ><a href="{{ route('user-profile', Auth::user()->username) }}"><span class="fa fa-user"></span> My profile</a></li>
	<li @if(Request::is('account/change/details')) class="active" @endif><a href="{{ route('account-change-details') }}"><span class="fa fa-edit"></span> Change account details</a></li>
	<li @if(Request::is('account/change/images')) class="active" @endif><a href="{{ route('account-change-images') }}"><span class="fa fa-picture-o"></span> Change images</a></li>
	<li @if(Request::is('account/change/password')) class="active" @endif><a href="{{ route('account-change-password') }}"><span class="fa fa-asterisk"></span> Change password</a></li>
	<li @if(Request::is('account/settings')) class="active" @endif><a href="{{ route('account-settings') }}"><span class="fa fa-cog"></span> Settings</a></li>
</ul>