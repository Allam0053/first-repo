@extends('layouts.master')
@section('content')
	<?php $parent=0?>
	<div class="row" style="margin-top: 20px;">
		<div class="content col-12 rounded-lg">
			<div class="card" style=" background-color:rgba(255, 255, 200, 0.7); border-radius: 10px; background-repeat: no-repeat; ">
				<div class="card-title text-white">
					<h3 style="margin-top: 10px;margin-bottom: 0px; color: blue"><strong>{{$forum->judul}}</strong></h3>
					<a href="#" style="color: black">oleh {{$forum->user->name}}, <small>{{$forum->created_at->diffForHumans()}}</small></a>
				</div>
			</div>
			<div class="card-body text-white"  style=" background-color:rgba(255, 255, 200, 0.7); border-radius: 10px">
				<p style="color: black; margin-left: 8%; margin-right: 8%;" class="text-justify">{{$forum->konten}}</p>
				@if(Auth::check())
					@if(auth()->user()->id == $forum->user_id)
						<!--edit forum-->
						<a class="btn btn-warning btn-sm float-right" style="margin-right: 5px" data-toggle="modal" data-target="#Modalforum">edit</a>
						
						<!-- Modal -->
						<div class="modal fade" id="Modalforum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header bg-secondary">
						        <h5 class="modal-titl text-white" id="ModalforumLabel">Edit Forum</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <form class="form" method="post" action="{{ route('edit_f') }}">
						      	<input type="hidden" name="id" value="{{ $forum->id }}">
						      	<div class="modal-body">
									@csrf
									<div class="form-group">
										<input class="form-control" type="text" name="judul" placeholder="judul" value="{{ $forum->judul }}">
									</div>
									<div class="form-group">
										<textarea class="form-control" name="konten" placeholder="Deskripsi">{{$forum->konten}}</textarea>
									</div>
						    	</div>
							    <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							        <button type="submit" class="btn btn-primary">Save changes</button>
							    </div>
							  </form>
						    </div>
						  </div>
						</div>
					@endif
				@endif
			</div>
			<div class="card-footer"  style=" background-color:rgba(255, 255, 200, 0.7); border-radius: 10px; margin-top: 10px">
				<!--komentar-->
				@foreach($forum->komentar as $kmn)
				@if($kmn->parent=='')
					<h5 class="text-justify"><strong>{{$kmn->user->name}}</strong>, <small>{{$kmn->created_at->diffForHumans()}}</small></h5>
					<p class="text-justify">{{ $kmn->konten }}</p>
					@if(Auth::check())
					<a href="javascript:void(0)" class="btn btn-primary float-left" style="margin-right: 5px" data-toggle="modal" data-target="#balaskomen{{$kmn->id}}">Balas</a>
					<!-- Modal -->
					<div class="modal fade" id="balaskomen{{$kmn->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header bg-secondary">
					        <h5 class="modal-titl text-white" id="exampleModalLabel">Membalas {{$kmn->user->name}}</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      
					      <form class="form" method="post" action="{{ route('komentar') }}">
					      	@csrf					
							<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">					
							<input type="hidden" name="forum_id" value="{{ $forum->id }}">
							<input type="hidden" name="parent" value="{{$kmn->id}}">
							<textarea type="text" name="konten" class="form-control" placeholder="balas komentar..."></textarea>
						    <div class="modal-footer">
						        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Save changes</button>
						    </div>
						  </form>
						  
					    </div>
					  </div>
					</div>
					@endif

					<!-- aksi komentar (oleh pembuat komentar) => edit/delete -->
					@if(Auth::check())	
						@if( auth()->user()->id == $kmn->user_id )
						<a href=" {{ route('delete_k', $kmn->id) }} " class="btn btn-danger btn-sm float-left" style="margin-right: 5px">delete</a>
						<a class="btn btn-warning btn-sm float-left" style="margin-right: 5px" data-toggle="modal" data-target="#Modalkomentar">edit</a>
						
						<div class="modal fade" id="Modalkomentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header bg-secondary">
						        <h5 class="modal-titl text-white" id="ModalkomentarLabel">Edit Komentar</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <form class="form" method="post" action="{{ route('edit_k') }}">
						      	<input type="hidden" name="id" value="{{ $kmn->id }}">
						      	<div class="modal-body">
									@csrf
									<div class="form-group">
										<textarea class="form-control" name="konten" placeholder="Deskripsi">{{$kmn->konten}}</textarea>
									</div>
						    	</div>
							    <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							        <button type="submit" class="btn btn-primary">Save changes</button>
							    </div>
							  </form>
						    </div>
						  </div>
						</div>
						@endif
					@endif
					<br><br>
					<!--balasan-->
					@foreach($kmn->child as $balasan)
						<h5 class="text-justify" style="margin-left: 7%"><strong>{{$balasan->user->name}}</strong>, <small>{{$balasan->created_at->diffForHumans()}}</small></h5>
						<p class="text-justify" style="margin-left: 7%">{{ $balasan->konten }}<br>
						<!-- aksi komentar (oleh pembuat komentar) => edit/delete -->
						@if(Auth::check())	
							@if( auth()->user()->id == $balasan->user_id )
							<a href=" {{ route('delete_k', $balasan->id) }} " class="btn btn-danger btn-sm">delete</a>
							<a class="btn btn-warning btn-sm" style="margin-right: 5px" data-toggle="modal" data-target="#Modalbalasan">edit</a>
							
							<!-- Modal -->
							<div class="modal fade" id="Modalbalasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header bg-secondary">
							        <h5 class="modal-titl text-white" id="ModalkomentarLabel">Edit Komentar</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <form class="form" method="post" action="{{ route('edit_k') }}">
							      	<input type="hidden" name="id" value="{{ $balasan->id }}">
							      	<div class="modal-body">
										@csrf
										<div class="form-group">
											<textarea class="form-control" name="konten" placeholder="Deskripsi">{{$balasan->konten}}</textarea>
										</div>
							    	</div>
								    <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary">Save changes</button>
								    </div>
								  </form>
							    </div>
							  </div>
							</div>
							@endif
						@endif
						</p>
					@endforeach

				@endif
				<br>
				@endforeach

				@if(Auth::check())
				<form class="form" method="post" action="{{ route('komentar') }}">
					@csrf					
					<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">					
					<input type="hidden" name="forum_id" value="{{ $forum->id }}">
					<input type="hidden" name="parent" value="">
					<textarea type="text" name="konten" class="form-control" placeholder="komentar..." style="background-color: rgba(255,255,255,0.4);" ></textarea>
					<button type="submit" class="btn btn-primary">submit</button>
				</form>
				@else
				<p class="alert alert-warning">mohon <a href="{{ route('dashboard') }}">log in</a> untuk komentar</p>
				@endif
			</div>
		</div>
	</div>
	

@endsection