@extends('layouts.home')
@section('title', 'Home')

@section('content')

<h2 class="cover-heading">Lei av folk som parkerer som en <em><a href="{{ url('/om') }}">idiot</a></em>?</h2>
<p class="lead">Du er ikke alene, det er mange der ute som irriterer seg over slikt. Her kan du finne haugevis med folk som har parkert som en <em><a href="{{ url('/om') }}">idiot</a></em>.</p>
<p class="lead"><em>Kanskje</em> du er en av dem? Trykk på knappen nedenfor og se om du finner en av dine biler. <em>Kanskje</em> du ønsker å vise folket enda en idiot? Registrer deg og last opp bilde og litt info om feilparkeringen.</p>
<p class="lead">Ønsker du å vise <em><a href="{{ url('/om') }}">idioten</a></em> at de har parkert feil? Da kan du laste ned PDF-en for å printe ut og henge på ruta.</p>
<p class="lead">
	<a href="{{ asset('pdf/duparkerersomenidiot_no.pdf') }}" class="btn btn-success"><i class="fas fa-download"></i> Last ned PDF</a>
	<small class="text-light"><em> ~ eller ~ </em></small>
	<a href="#" class="btn btn-info"><i class="fas fa-car"></i> Se feilparkerte biler</a>
</p>

@endsection
