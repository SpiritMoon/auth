@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			{!! Notification::showAll() !!}
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form-group">
				<label for="authType">授权类型 </label>
				{!! Form::select(
						'controllerVersion', 
						array(
							'/site/detail/'.$site_id.'?auth_type=nopassword'=>'无需密码',
							'/site/detail/'.$site_id.'?auth_type=password'=>'密码',
							'/site/detail/'.$site_id.'?auth_type=sms'=>'短信'),
							'/site/detail/'.$site_id.'?auth_type='.$auth_type,
							array('onchange'=>'window.location=this.value'
							)
						) 
				!!}
			</div>
			{!! Form::open(array('enctype' => 'multipart/form-data', 'url' => '/site/detail/')) !!}
				<div class="form-group">
					<label for="authTime">授权时间(分钟)</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['authTime']; ?>" type="text" class="form-control" id="authTime" name="authTime" placeholder="3000">
				</div>
				<div class="form-group">
					<label for="redirectUrl">跳转页面</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['redirectUrl']; ?>" type="text" class="form-control" id="redirectUrl" name="redirectUrl" placeholder="http://www.baidu.com">
				</div>
				<div class="form-group">
					<label for="waitTime">广告等待时间(秒)</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['waitTime']; ?>" type="text" class="form-control" id="waitTime" name="waitTime" placeholder="5">
				</div>
				<div class="form-group">
					<label for="waitPic">广告图片(不能大于1M)</label>
					@if (is_array($config) && count($config) > 0)
					<p>
						<img src="/images/sites/{{ $config['waitPic'] }}" alt="" max-width="100">
					</p>
					@endif
					<input type="file" class="" id="waitPic" name="waitPic" placeholder="">
				</div>
				@include('site.authType.'.$auth_type)
                <input type="hidden" name="auth_type" value="{{ $auth_type }}" />
                <input type="hidden" name="site_id" value="{{ $site_id }}" />
                @if (isset($config['waitPic']) && $config['waitPic'])
                    <input type="hidden" name="_waitPic" value="{{ $config['waitPic'] }}" />
                @endif
                <button type="submit" class="btn btn-default">提交</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection