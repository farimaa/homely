@extends('admin.dashboard')
@section('title', 'بنر ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-unstyled">
                    <li>{{ Session::get('alert-' . $msg) }}</li>
                </ul>
            </div>
            @endif
        @endforeach
        <a href="/admin/manage/baner/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد بنر جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				بنرها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان یا توضیح:</label>
				   	 	<input type="text" class="form-control input-sm" id="name" name="name" value="{{ 
				   	 	Request::input('name') }}">
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		{{ $baners->total() }} مورد یافت شد.
			    	</span>				  	
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						<a class="inline-flex" sort="id">
						 شمارنده 
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="title"> عنوان </a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="description"> توضیحات </a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="user_id"> نویسنده </a>
					</th>
					<th>
						<a class="inline-flex" sort="location"> مکان در صفحه </a>
					</th>
					<th>
						تصویر
					</th>
					<th>
						<a class="inline-flex" sort="status"> وضعیت </a>
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($baners) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($baners as $baner)
					<tr>
						<td class="text-center width-50px" >
							{{ $baner->id }}
						</td>
						<td>
							{{ $baner->title}}
						</td>
						<td class="hidden-xs description-div">
							{{ $baner->description}}
						</td>
						<td class="hidden-xs">
							{{ $baner->user ? $baner->user->first_name : 'ندارد'}}
							{{ $baner->user ? $baner->user->last_name : 'ندارد'}}
						</td>
						<td>
							{{ $baner->location_translate() }}
						</td>
						<td class="width-20percent">
							<img src="{{ $baner->base_image_100() }}" class="img-thumbnail image-table">
						</td>
						<td class="min-width-110">
							<select class="form-control" 
								onchange="statusChanged(this, {{ $baner->id }}, 'baner')">
								@foreach(\App\Models\baner::$STATUS as $key => $value)
								<option value='{{$key}}' {{ $baner->status == $key ? 'selected' : '' }}> {{$value}} </option> 
								@endforeach
							</select>
						</td>
						<td class="width-80px">
							<a href="/admin/manage/baner/{{ $baner->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/baner/{{ $baner->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<div class="one-third-seperate"></div>
							<form action="/admin/manage/baner/{{ $baner->id }}" method="POST" class="display-inline">
							    {{ method_field('DELETE') }}
							    {{ csrf_field() }}
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			{{ $baners->links() }}
		</div>
	</div>
</div>
@endsection
@push('script')



<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>
@endpush