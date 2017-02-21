@inject('contentattr' , 'App\Classes\Blade\PageMeta')
@extends(config('phantom.theme.folder').config('phantom.theme.layout'))

@section('meta')
	{{ $contentattr->getInformation(
			$page_content, 
			array(
				'author' => 'Wouter van Marrum',
				'robots' => 4,
			)
		)
	}}
@endsection()

@section('content')

	@if ($page_content->content->count() > 0)
		@foreach ($page_content->content as $content_block)
			{!! $content_block->content !!}
		@endforeach
	@endif
@endsection