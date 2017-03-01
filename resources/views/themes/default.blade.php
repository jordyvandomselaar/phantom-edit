@extends(config('phantom.theme.layout'))

@push('meta')
    {!! $meta->getInformation($page_content) !!}
@endpush

@section('content')
	@if ($page_content->content->count() > 0)
		@foreach ($page_content->content as $content_block)
			{!! $content_block->content !!}
		@endforeach
	@endif
@endsection