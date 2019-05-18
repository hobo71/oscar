<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Camino</title>
	<link rel="stylesheet" href="{{ asset('css/reveal.css') }}">
    <link  href="{{ asset('css/slide.css') }}" rel="stylesheet"  />

	</head>
	<body>
		<div class="reveal">
			<div class="slides">
				@foreach($vehiculos as $vehiculo)
					<section data-background-image="{{ asset('uploads/vehiculos/'.$vehiculo->foto) }}">
						<div class="main">
							<h2>{!! $vehiculo->marca->nombre !!}  <strong>{!! $vehiculo->modelo !!}</strong></h2>
							{{-- <h3 style="margin-bottom: 15px;">{!! $vehiculo->alquilado() !!}</h3> --}}
							<dl>
								<dt >Patente</dt>
								<dd >{{ $vehiculo->patente }}</dd>
								<dt >ciudad</dt>
								<dd >{{ $vehiculo->ciudad }}</dd>
								<dt >puertas</dt>
								<dd >{{ $vehiculo->puertas }}</dd>
								<dt >Año</dt>
								<dd >{{ $vehiculo->anio }}</dd>
								<dt >cubiertas</dt>
								<dd >{{ $vehiculo->cubiertas }}</dd>
								<dt >kilometros</dt>
								<dd >{{ $vehiculo->kilometros }}</dd>
							</dl>
						</div>
					</section>
				@endforeach
			</div>
		</div>
		<script src="{{ asset('js/reveal.js') }}"></script>
		<script>
			Reveal.initialize({
				controls: true,
				progress: true,
				defaultTiming: 15,
				slideNumber: true,
				history: false,
				keyboard: true,
				overview: false,
				center: false,
				touch: true,
				loop: true,
				rtl: false,
				shuffle: false,
				fragments: true,
				embedded: false,
				help: true,
				showNotes: false,
				autoPlayMedia: null,
				autoSlide: 10000,
				autoSlideStoppable: false,
				autoSlideMethod: Reveal.navigateNext,
				mouseWheel: true,
				hideAddressBar: true,
				previewLinks: false,
				transition: 'fade', // none/fade/slide/convex/concave/zoom
				transitionSpeed: 'slow', // default/fast/slow
				backgroundTransition: 'fade', // none/fade/slide/convex/concave/zoom
				viewDistance: 3,
				parallaxBackgroundImage: '', // e.g. "'https://s3.amazonaws.com/hakim-static/reveal-js/reveal-parallax-1.jpg'"
				parallaxBackgroundSize: '', // CSS syntax, e.g. "2100px 900px"
				parallaxBackgroundHorizontal: null,
				parallaxBackgroundVertical: null,
				display: 'block',
				width: "100%",
				height: "100%",
				margin: 0,
				minScale: 1,
				maxScale: 1
			});

		</script>
	</body>
</html>