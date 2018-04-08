<ul class="seatmap">
	<li class="top-row">
		<ul>
			<li class="emergency-exit emergency-exit-top"><p>Nødutgang</p></li>
			<li class="entrance"><p>INNGANG</p></li>
		</ul>
	</li>
	<li class="emergency-row">
		<ul>
			<li class="emergency-exit emergency-exit-left"><p>Nødutgang</p></li>
			<li class="emergency-exit emergency-exit-left gate"><p>Port</p></li>
		</ul>
	</li>
	<ul class="seat-rows">
		@foreach($rows as $row)
			<li class="seat-row" @if($row->slug == 'l') style="margin-top:20px;" @endif>
				<ul class="seat-row-{{$row->slug}}">
					
					@foreach($row->seats as $seat)
						@if($seat->slug == 'a7')
							<li class="seat kiosk" id="kiosk"><p><span class="fa fa-coffee"></span></p></li>
						@endif
						<li class="seat @if($seat->reservationsThisYear()->count() > 0) @if($seat->reservationsThisYear()->first()->status->id == 1) seat-reserved @elseif($seat->reservationsThisYear()->first()->status->id == 2) seat-tempreserved @endif @if(Sentinel::getUser()->id == $seat->reservationsThisYear()->first()->reservedfor->id and $seat->reservationsThisYear()->first()->status->id == 1) seat-yours @endif  @endif @if(Request::segment(3) == $seat->slug) active @endif ">
							<p>
								@if($seat->reservationsThisYear()->count() == 0)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Available">{{ $seat->name }}</a>
								@elseif(Sentinel::getUser()->id == $seat->reservationsThisYear()->first()->reservedfor->id and $seat->reservationsThisYear()->first()->status->id == 1)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="This seat is reserved for you!">{{ $seat->name }}</a>
								@elseif($seat->reservationsThisYear()->first()->status->id == 1)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Reserved for: {{ User::getFullnameAndNicknameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}">{{ $seat->name }}</a>
								@elseif($seat->reservationsThisYear()->first()->status->id == 2)
									<a href="{{ route('seating-show', $seat->slug) }}" data-toggle="tooltip" title="Temporary Reserved By: {{ User::getFullnameAndNicknameByID($seat->reservationsThisYear()->first()->reservedfor->id) }}">{{ $seat->name }}</a>
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
	<li class="emergency-row-bottom">
		<ul>
			<li class="emergency-exit emergency-exit-bottom"><p>Nødutgang</p></li>
			<li class="emergency-exit emergency-exit-bottom"><p>Nødutgang</p></li>
		</ul>
	</li>
</ul>