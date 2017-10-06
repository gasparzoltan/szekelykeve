@extends('main')

@section('content')
	<div class="wrap-read-article">
		<div class="tartalom">

			<div class="cikk">
				<div class="kenyerszelet">
					<div class="ui breadcrumb">
					  <a class="section">Hírek</a>
					  <span class="divider">/</span>
					  <a class="section">{{ $article->category->name }}</a>
					  <span class="divider">/</span>
					  <div class="active section">{{ $article->title }}</div>
					</div>				

				</div>				
				<h1 class="cim">
					{{ $article->title }}
				</h1>
				<div class="datum">{{ $article->created_at }}</div>

				@if($article->image != '')
					<div class="kiemelt-kep">
						<img src="/images/article/medium_{{$article->image}}">
					</div>
				@endif

				<div class="tartalom-resz">
					{!! $article->content !!}
				</div>
			</div>	

			<div class="cikk-lista">
				<div class="fejlec">Legfrissebb</div>
				<div class="oszto"><div class="belso-oszto"></div></div>

				<div class="latests">
					@foreach($latests as $latest)
						
							<a href="{{route('view.article', $latest->slug)}}" class="friss-cikk">
								@if($latest->image != '')
									<div class="kep">
										<img src="/images/article/thumb_{{$latest->image}}">
									</div>
								@endif
								<div class="szoveg">
									<div class="cim">{{ str_limit($latest->title, 40) }}</div>
								</div>	
							</a>	

							<div class="ui divider"></div>				
					@endforeach
				</div>
			</div>	


		</div>
	</div>
@endsection
