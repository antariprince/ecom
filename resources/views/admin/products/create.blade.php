@extends('layouts.app')

@section('content')
	@if(count($errors) > 0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list-group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif
	<div class="panel pane-default">
		<div class="panel-heading text-center">
			Create a new product
		</div>
		<div class="panel-body">
			<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" value="{{ old('name') }}">
				</div>	
				
				<div class="form-group">
					<label for="image">Product image</label>
					<input type="file" class="form-control" name="image">
				</div>	

				<div class="form-group">
					<label for="name">Price</label>
					<input type="text" class="form-control" name="price" value="{{ old('price') }}">
				</div>	

				<div class="form-group">
					<label for="content">Description</label>
					<textarea name="description" id="content" cols="5" rows="5" class="form-control">{{ old('description') }}</textarea>
				</div>	
				<div class="form-group">
						<div class="text-center"><button class="btn btn-success" type="submit">Store Product</button></div>
					</div>	
			</form>
		</div>
	</div>
@stop

@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@stop
@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<!--  <script>
    $(document).ready(function() {
        $('#content').summernote();
    });
  </script> -->
@stop