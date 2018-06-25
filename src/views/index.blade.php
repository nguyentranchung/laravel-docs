@extends(config('laraveldocs.layout'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Info:</strong> Bài viết được lấy từ nguồn <a href="https://github.com/petehouston/laravel-docs-vn">https://github.com/petehouston/laravel-docs-vn</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3 col-md-3 col-lg-3">
			@include('LRDocs::sidebar')
		</div>
		<div class="col-sm-9 col-md-9 col-lg-9">
			<div class="well well-sm content">
				{!! $contents !!}
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/googlecode.min.css" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>
<script>
	$(document).ready(function() {
		$('pre code').each(function(i, block) {
			hljs.highlightBlock(block);
		});
		$("a[href*='#']").on('click', function() {
			var top = 0;
			if (top = $("h2:contains("+ $(this).text() +")" ).offset().top) {

			}
			else if (top = $("h3:contains("+ $(this).text() +")" ).offset().top) {

			}
			else {
				top = $("h4:contains("+ $(this).text() +")" ).offset().top;
			}
			$('html, body').scrollTop(top - 5);
		});
	});
</script>
@endpush