@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <th>{{ __('account.members.name') }}</th>
                    <th>{{ __('account.members.username') }}</th>
                    <th>{{ __('account.members.submissions') }}</th>
                    <th>{{ __('account.members.created_at') }}</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if(!$user->anon)
                                    {{ $user->name }}
                                @elseif($user->anon)
                                    <span class="text-uppercase"><em>{{ trans('account.profile.hidden') }}</em></span>
                                @endif
                            </td>
                            <td>
                                @if(!$user->anon)
                                    <a href="{{ route('user.show', $user->uuid) }}">{{ $user->username }}</a>
                                @elseif($user->anon)
                                    <a href="{{ route('user.show', $user->uuid) }}">{{ $user->uuid }}</a>
                                @endif
                            </td>
                            <td>{{ $user->submissions->count() }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection