@extends('main')

@section('content')
<div class="wrap-landing-page">
	<div class="tartalom">
		<div class="left-bar">
			<div class="ui sticky">
				<br>
				<br>
				<br>
				<div class="kategoriak">
					<?php 
						$colors = ['blue', 'red', 'green', 'orange', 'violet'];
						$x = 0;
					?>


					@foreach($categories as $category)						
						<a href="#" class="kategoria" style="border-color: {{ $colors[$x] }}" >
							<div href="#">
								{{ $category->name }} 
							</div>
							<span class="ui mini label">{{ $category->articles->count() }}</span>
						</a>
						<?php 
							$x++;
						?>
					@endforeach					
				</div>
			</div>
		</div>
		<div class="main-bar">
			@if($highlightedArticle)
				<div class="kiemelt-cikk">
					<div class="kep">
						<div class="cim"><h3><a href="{{route('view.article', $highlightedArticle->slug)}}">{{ $highlightedArticle->title }}</a></h3></div>
						<div class="kategoria"><a class="ui blue tag mini label">{{ $highlightedArticle->category->name }}</a></div>
						<a href="{{route('view.article', $highlightedArticle->slug)}}"><img src="/images/article/medium_{{$highlightedArticle->image}}"></a>
					</div>
					<div class="szoveg">						
						<div class="infok">
							<div class="datum">{{ $highlightedArticle->created_at }} | {{ $highlightedArticle->category->name }}
							</div>										
							<div class="bovebben">
								<a href="{{route('view.article', $highlightedArticle->slug)}}" class="ui green basic mini button">BŐVEBBEN &rarr;</a>
							</div>										
						</div>
					</div>
				</div>
			@endif
			
			<h4 class="ui horizontal divider header divider-aktualis">				  
			  Aktuális hírek
			</h4>

			<div class="aktualis-cikkek">
				@foreach($articles as $article)					
					<div class="cikk">							
						<div class="kep">							
							<img src="@if($article->image == '') /images/test/thumb_szOV1aVexlJ8Xgohvagf-1506946105.jpg @else /images/article/thumb_{{ $article->image }} @endif">
						</div>
						<div class="szoveg">
							<div class="cim">
								<h4><a href="{{route('view.article', $article->slug)}}">{{ $article->title }}</a></h4>
							</div>							
							<div class="infok">
								<div class="datum">{{ $article->created_at }} | {{ $article->category->name }}</div>
							</div>
							<div class="bovebben">
								<a href="{{route('view.article', $article->slug)}}" class="">BŐVEBBEN &rarr;</a>
							</div>
						</div>
					</div>
				@endforeach		
			</div>

			
		</div>
		<div class="right-bar">
			<div class="ui sticky">
				<br>
				<br>
				<br>				
				<div class="fejlec">Látogatóink</div>
				<div class="oszto"><div class="belso-oszto"></div></div>

				<div class="countries">
					@foreach($visitors as $visitor)
						<div class="orszag">
							<i class="{{$visitor->code}} flag"></i> {{ $visitor->name }} <span class="ui mini label">{{$visitor->times_visited}}</span>
						</div>
					@endforeach						
				</div>			
			</div>
		</div>
	</div>
</div>		
@endsection

@push('javascript')
	<script type="text/javascript">
		$('.ui.dropdown').dropdown();
	
		$('.ui.sticky')
		  .sticky({
		    context: '.left-bar, .right-bar'
		});		
	</script>
@endpush




{{-- 
	<div class="wrap-bars">
		<div class="left-bar">
			<div class="left-bar-content">
				
			</div>
		</div>
		
		<div class="main-bar">
			<div class="main-bar-content">
				@if($highlightedArticle)
					<div class="highlighted-content">
						@if($highlightedArticle->image != '')
							<div class="highlighted-image" style="position: relative;">
								<div class="ui blue ribbon label mini" style="position: absolute; top: 15px; left: -12px;">
									{{ $highlightedArticle->category->name }}
								</div>	
								<a href="#">							
									<img src="/images/article/medium_{{$highlightedArticle->image}}">
								</a>
							</div>
							<div class="highlighted-text">
								<h3>
									<a href="#">{{ $highlightedArticle->title }}</h3>
								</h3>
								<div>
									<small>{{ $highlightedArticle->created_at }}</small>
								</div>
							</div>
						@endif
					</div>
				@endif
			</div>
		</div>

		<div class="right-bar">
			<div class="right-bar-content">
				
			</div>			
		</div>		
	</div> --}}