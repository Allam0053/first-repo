@extends('layouts.masterdash')

@section('buttonlogin')
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdroplogin">log in</button>
@endsection
@section('buttonsignup')
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdropsignup">sign up</button>
@endsection

@section('content')
@if(session('gagal'))
	<div class="toast fixed-top" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="margin: 0 auto 0 auto;">
		<div class="toast-header">
			<strong class="mr-auto">log in notifikasi</strong>
			<small class="text-muted">Baru saja</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="toast-body">
			{{session('gagal')}}
		</div>
	</div>
@endif
@if(session('logouted'))
	<div class="toast fixed-top" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="margin: 0 auto 0 auto;">
		<div class="toast-header">
			<strong class="mr-auto">log out notifikasi</strong>
			<small class="text-muted">Baru saja</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="toast-body">
			{{session('logouted')}}
		</div>
	</div>
@endif
@if(session('sukses'))
	<div class="toast fixed-top" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="margin: 0 auto 0 auto;">
		<div class="toast-header">
			<strong class="mr-auto">sign up notifikasi</strong>
			<small class="text-muted">Baru saja</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="toast-body">
			{{session('sukses')}}
		</div>
	</div>
@endif

<div class="row" style="margin-top: 30px">
	<!--taruh konten disini-->
</div>
@endsection


