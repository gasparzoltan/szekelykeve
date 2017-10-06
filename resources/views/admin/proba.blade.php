@extends('admin.main');


@section('content')
<div id="tinymce-form">
	<tiny-mce id="description" v-model="content"></tiny-mce>
</div>

@endsection



@push('javascript')
	<script type="text/javascript">

	

	new Vue({
	  	el: '#tinymce-form',
	    data: {
	    	content: 'hello world'
	    }
  	});

	</script>
@endpush