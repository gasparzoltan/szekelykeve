
@foreach($images->chunk(4) as $imgs)

	<div class="row">
		@foreach($imgs as $image)
			<div class="col-sm-3" id="img-wrap-{{$image->id}}">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<img width="100%" src="/images/article/thumb_{{$image->name}}">
								<div>
									<label class="">
										<input 										
										type="checkbox"
										class="chkGallery"
										data-img-id="{{$image->id}}"
										data-route="{{route('admin.set.gallery.image', $image->id)}}"
										@if($image->is_gallery_image == 1) checked @endif> Galéria kép
									</label>
								</div>		
								<div>
									<label >
										<input 
										type="radio" 
										name="thumbnail"
										class="radThumbnail"
										data-img-id="{{$image->id}}"
										data-route="{{route('admin.set.thumbnail.image', $image->id)}}" 
										@if($image->is_thumbnail_image == 1) checked @endif
										 > Elsődleges kép
									</label>
								</div>	
								<div><input style="width:100%" type="text" value="/images/article/{{$image->name}}" onClick="this.select();"></div>
								<hr>								
								<div>
									<button 
										class="btn btn-default btn-xs btnDelImg" 
										data-img-id="{{$image->id}}"
										data-route="{{route('admin.fenykep-torlese', $image->id)}}"
										>Törlés</button>
								</div>																				
							</div>
						</div>		
					</div>
				</div>
			</div>
		@endforeach		
	</div>

@endforeach