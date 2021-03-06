<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	@include('inc_header')<?php $pageName="download_doc"; ?>
</head>

<body>
	<style>
		.wrap_parallax {
			position: relative;
			height: 30vh;
			overflow: hidden;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.page-item.active .page-link {
			z-index: 1;
			color: #fff;
			background-color: #379595;
			border-color: #379595;
		}
		.page-link {
			position: relative;
			display: block;
			padding: 0.4rem 0.75rem;
			margin-left: -1px;
			line-height: 1.25;
			color: #007bff;
			background-color: #fff;
			border: 1px solid #dee2e6;
		}
	</style>
	@php
		$lang = "";
		if (session()->get('locale') == null){
			$lang = "th";
		}elseif (session()->get('locale') == "th") {
			$lang = "th";
		}elseif(session()->get('locale') == "en"){
			$lang = "en";
		}		
	@endphp
	@include('inc_topmenu')
		<div class="container-fluid nopad">
			<div class="row">
				<div class="col">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('messages.home')}}</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{trans('messages.report')}}</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<section class="wrap_parallax">
			<div class="overlay">
				<div class="parallax">
					<div class="container-fluid nopad">
						<div class="row">
							<div class="col">
								<div class="bannertop_loaddoc">
									<div class="container">
										<div class="row">
											<div class="col">
												<div class="bannertxt_top">
													<h5>INNOTECH</h5>
													<h1>{{ trans('messages.publication') }}<span class="boldtext"> DOWNLOAD</span></h1> </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="container">
			<div class="row mt-5">
				<div class="col  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
					<div class="title_head1"> {{ trans('messages.publication') }} <span class="bluetxt">{{ trans('messages.announcements') }}</span> </div>
				</div>
			</div>
			<br><br>
			<div class="wow fadeInDown" data-wow-duration="1.3s" data-wow-delay="0.1s">
				<div class="row">
					<div class="col">
					
							@foreach ($file_type as $k_file_type => $_file_type)
								
									<div class="box_download_doc">
										<div class="numberlist">
											{{$k_file_type+ $file_type->firstItem()}}
										</div>
										<div class="detail_doc">
											{{$file_type[$k_file_type]['name_'.$lang]}}
										</div>
										<div class="btn_download">
											@if ($_file_type->list_type == 'L')
												<a href="{{url('download/detail/'.$_file_type->id)}}" class="btn btn-primary">{{ trans('messages.detail') }}</a> 
											@else
												<a href="{{url('download/listdetail/'.$_file_type->id)}}" class="btn btn-primary">{{ trans('messages.detail') }}</a> 
											@endif
										</div>
									</div>
								
							
							@endforeach
					
						
						{{-- <div class="box_download_doc">
							<div class="numberlist">
								02
							</div>
							<div class="detail_doc">
								รายงานการลงทุนในตราสารหนี้
							</div>
							<div class="btn_download">
								<a href="{{url('/downloadinside')}}" class="btn btn-primary">ดูรายละเอียด</a> 
							</div>
						</div> --}}
						{{-- <div class="box_download_doc">
							<div class="numberlist">
								03
							</div>
							<div class="detail_doc">
								รายงานการทำธุรกรรมต่างๆ
							</div>
							<div class="btn_download">
								<a href="{{url('/downloadinside')}}" class="btn btn-primary">ดูรายละเอียด</a> 
							</div>
						</div> --}}
						{{-- <div class="box_download_doc">
							<div class="numberlist">
								04
							</div>
							<div class="detail_doc">
								การใช้สิทธิออกเสียงในที่ประชุม
							</div>
							<div class="btn_download">
								<a href="{{url('/downloadinside')}}" class="btn btn-primary">ดูรายละเอียด</a> 
							</div>
						</div> --}}
					</div>
				</div>
			</div>
			<div class="row mt-5 mb-5 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay="0.1s">
				<div class="col">
					<div class="pagination_bot">
						<nav class="pagination-container">
							<div class="pagination"> 
									{{ $file_type->links() }}
								{{-- <a class="pagination-newer" href="#"><i class="fas fa-angle-left"></i></a> <span class="pagination-inner">
											<a href="#">1</a>
											<a class="pagination-active" href="#">2</a>
											<a href="#">3</a>
											<a href="#">4</a>
											<a href="#">5</a>
										</span> <a class="pagination-older" href="#"><i class="fas fa-angle-right"></i></a>  --}}
								</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<main> </main>
		@include('inc_footer')
			<script>
				// for heading
				$(window).scroll(function () {
					const a = $(this).scrollTop()
						, b = 800;
					$("h1").css({
						backgroundPosition: "center " + a / 2 + "px"
					});
					$(".parallax").css({
						top: a / 1.6 + "px"
						, opacity: 2 - a / b
					});
				});
			</script>
			<script>
				$('.pagination-inner a').on('click', function () {
					$(this).siblings().removeClass('pagination-active');
					$(this).addClass('pagination-active');
				})
			</script>
</body>

</html>