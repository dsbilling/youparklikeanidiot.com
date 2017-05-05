<div class="seatmap">
	<ul>
		<li class="scene">Scene</li>
		<li class="entrance" id="entrance"><p><span class="fa fa-sign-in"></span></p></li>
		@foreach($rows as $row)
			<li class="seat-row">
				<ul class="seat-row-{{$row->slug}}">
					@if($row->slug == 'a')
						<li class="seat kiosk" id="kiosk"><p><span class="fa fa-coffee"></span></p></li>
					@endif
					@foreach($row->seats as $seat)
						<li class="seat @if($seat->reservations->count() <> 0) @if($seat->reservations->first()->status->id == 1) seat-reserved @elseif($seat->reservations->first()->status->id == 2) seat-tempreserved @endif @if(Sentinel::getUser()->id == $seat->reservations->first()->reservedfor->id and $seat->reservations->first()->status->id == 1) seat-yours @endif @endif @if(Request::segment(3) == $seat->slug) active @endif ">
							<p>
								@if($seat->reservations->count() == 0)
									<a href="{{ URL::route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Available">{{ $seat->name }}</a>
								@elseif(Sentinel::getUser()->id == $seat->reservations->first()->reservedfor->id and $seat->reservations->first()->status->id == 1)
									<a href="{{ URL::route('admin-seating-reservation-edit', $seat->reservations->first()->id) }}" data-toggle="tooltip" title="This seat is reserved for you!">{{ $seat->name }}</a>
								@elseif($seat->reservations->first()->status->id == 1)
									<a href="{{ URL::route('admin-seating-reservation-edit', $seat->reservations->first()->id) }}" data-toggle="tooltip" title="Reserved for: {{ User::getUsernameAndFullnameByID($seat->reservations->first()->reservedfor->id) }}">{{ $seat->name }}</a>
								@elseif($seat->reservations->first()->status->id == 2)
									<a href="{{ URL::route('admin-seating-reservation-edit', $seat->reservations->first()->id) }}" data-toggle="tooltip" title="Temporary Reserved By: {{ User::getUsernameAndFullnameByID($seat->reservations->first()->reservedfor->id) }}">{{ $seat->name }}</a>
								@else
									{{ $seat->name }}
								@endif
							</p>
						</li>
					@endforeach
				</ul>
			</li>
		@endforeach
	</ul>
</div>