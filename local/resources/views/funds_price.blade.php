<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	@include('inc_header') 
	@include('connect')
	<?php $pageName="fundsprice"; ?>
</head>
{{-- {{dd($result)}} --}}
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
		
		.title_head1 {
			text-align: left;
		}
		
		.display-slide {
			display: none;
		}
		
		.nav_list {
			margin-top: 50px;
		}
		
		.nav_list li {
			width: auto;
			display: inline-block;
			margin-right: 10px;
			font-size: 1.2em;
		}
		
		.nav_list li.active {
			background-color: #379494;
			border-radius: 50px;
			padding: 10px 25px;
			font-family: 'Kanit';
		}
		
		.nav_list li.active a {
			color: white;
		}
		
		.table-bordered {
			border: none;
		}
		@media (max-width: 767px) {
			.nav_list li.active{
				margin-left: -6px;
			}
			.nav_list li{
				width: 100%;
				margin-bottom: 20px;
			}
				.bannertxt_top {
		margin-top: 5em;
			}
		}
	</style>
	@include('inc_topmenu')
		<div class="container-fluid nopad">
			<div class="row">
				<div class="col">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('messages.home')}}</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{trans('messages.nav')}}</li>
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
								<div class="bannertop_funds">
									<div class="container">
										<div class="row">
											<div class="col">
												<div class="bannertxt_top">
													<h5>INNOTECH</h5>
													<h1>มูลค่าหน่วยลงทุน <span class="boldtext"> NAV</span></h1> </div>
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
		<main>
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="nav_list select-display-slide">
							<li class="active" rel="1"> <a href="javascript:void(0)">มูลค่าหน่วยลงทุน</a> </li>
							<li rel="2"> <a href="javascript:void(0)">  มูลค่าหน่วยลงทุนย้อนหลัง </a> </li>
						</div>
					</div>
				</div>

				<br> </div>
			<div class="container-fluid nopad">
			<div class="row">
				<div class="col">
								<div class="container">
				<div class="row">
					<div class="col">
						<div class="funds_content">
							<div class="display-slide" rel="1" style="display:block;">
											<div class="row mt-5">
											<div class="col-md-9">
												<div class="title_head1">มูลค่าหน่วยลงทุน <span class="bluetxt">NAV</span> </div>
											</div>
											<div class="col-md-3">
												<div class="select_nav">
													<select id="funds" name="selectbasic" class="form-control" onchange="getFund(this)">
														@if ($result[0]->StrFundShortName == 'EP-LTF')
															<option value="001" selected>กองทุนเปิดเอคควิตี้โปร หุ้นระยะยาว</option>
															<option value="016" >กองทุนเปิดโซลาริสตราสารทุนเพื่อการเลี้ยงชีพ</option>
														@else
															<option value="001" >กองทุนเปิดเอคควิตี้โปร หุ้นระยะยาว</option>
															<option value="016" selected>กองทุนเปิดโซลาริสตราสารทุนเพื่อการเลี้ยงชีพ</option>
														@endif
													</select>
												</div>
											</div>
										</div>
								<br>
								<table class="table funds_table table-bordered table-responsive-lg">
									<thead>
										<tr class="bg_orange">
											@if ($result[0]->StrFundShortName == 'EP-LTF')
												<th colspan="9" class="text-left"><a href="{{url('fundsepltf')}}">กองทุนเปิดเอคควิตี้โปร หุ้นระยะยาว</a></th>	
											@else
												<th colspan="9" class="text-left"><a href="{{url('fundsepltf')}}">กองทุนเปิดโซลาริสตราสารทุนเพื่อการเลี้ยงชีพ</a></th>	
											@endif
										</tr>
										<tr>
											<th scope="col">ชื่อย่อ</th>
											<th scope="col">วันที่</th>
											<th scope="col">มูลค่าทรัพย์สินสุทธิ</th>
											<th scope="col">มูลค่า NAV</th>
											<th scope="col">ราคาขาย</th>
											<th scope="col">ราคารับซื้อคืน</th>
											<th scope="col">เปลี่ยนแปลง (%)</th>
											<th scope="col">เปลี่ยนแปลง (บาท)</th>
										</tr>
									</thead>
									<tbody>
										
									@foreach ($result as $_result)
								
										@php
											$date = new DateTime($_result->DTENAVDATE);
											$newdate = $date->format('d/m/Y');												
										@endphp
											<tr>
												<th scope="row">{{$_result->StrFundShortName}}</th>													
													<td>{{$newdate}}</td>
													<td>{{number_format($_result->DECNAV,2)}}</td>
													<td>{{number_format($_result->DECNAV_UNIT,2,'.','')}} </td>
												@if ($_result->DECPURCHASE == null)
													<td>N/A</td>
												@else
													<td>{{number_format($_result->DECPURCHASE,2,'.','')}} </td>
												@endif
												
												@if ($_result->DECREDEEM == null)
													<td>N/A</td>
												@else
													<td>{{number_format($_result->DECREDEEM,2,'.','')}} </td>
												@endif
												@php
													$bath = $_result->DACNAVLAST - $_result->DACNAVBEFOR;
													$percent = ($bath*100)/100;
												@endphp
												
												<td><span class="greentext"><b>{{number_format($percent,2,'.','')}}</b></span></td>
												

												<td><span class="greentext"><b>{{number_format($bath,2,'.','')}}</b></span></td>
											</tr>
									@endforeach
										{{-- <tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b>
											</span> </td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
										</tr> --}}
									</tbody>
								</table>
							</div>
							<div class="display-slide" rel="2">
										<div class="row mt-5">
									<div class="col">
										<div class="title_head1">มูลค่าหน่วยลงทุนย้อนหลัง <span class="bluetxt">NAV</span> </div>
									</div>
								</div>
								<br>
								<div class="bggray alignfull mb-3">
									<div class="container">
										<div class="box_search">
											<form id="search" action="{{url('fundsprice/seachfundprice')}}" method="get" >
												<div class="row">
													<div class="col-lg-5">
														<div class="search_funds">
															<label>เลือกกองทุน</label>
															<select id="funds_all" name="type" name="selectbasic" class="form-control">
																@if ($result[0]->StrFundShortName == 'EP-LTF')
																	<option value="001" selected>กองทุนเปิดเอคควิตี้โปร หุ้นระยะยาว</option>
																	<option value="016" >กองทุนเปิดโซลาริสตราสารทุนเพื่อการเลี้ยงชีพ</option>
																@else
																	<option value="001" >กองทุนเปิดเอคควิตี้โปร หุ้นระยะยาว</option>
																	<option value="016" selected>กองทุนเปิดโซลาริสตราสารทุนเพื่อการเลี้ยงชีพ</option>
																@endif
																
															</select>
														</div>
													</div>
													<div class="col-lg-5">
														<div class="search_funds">
															<label>เลือกวันที่ต้องการแสดงข้อมูล</label>
															<form action="example.php" method="post">
																<input autocomplete="off" class="datepicker form-control boxbox"  name="date" id="date" placeholder="DD/MM/YY" /> </form>
														</div>
													</div>
													<div class="col-lg-2"> <button type="submit" class="btn btn-success">{{trans('messages.submit')}}</button> </div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="sec_title">
											@php
											
												$date = new DateTime($result[0]->DTENAVDATE);
											
												$newdate = $date->format('Y/m/d');
												$date_create_edit = explode('/', $newdate);												
												$month = $date_create_edit[1];
												$year   = $date_create_edit[0] + 543;
												$day = $date_create_edit[2];

												switch ($month) {
													case '01':
														$month = "มกราคม";
														break;
													case '02':
														$month = "กุมภาพันธ์";
														break;
													case '03':
														$month = "มีนาคม";
														break;
													case '04':
														$month = "เมษายน";
														break;
													case '05':
														$month = "พฤษภาคม";
														break;
													case '06':
														$month = "มิถุนายน";
														break;
													case '07':
														$month = "กรกฎาคม";
														break;
													case '08':
														$month = "สิงหาคม";
														break;
													case '09':
														$month = "กันยายน";
														break;
													case '10':
														$month = "ตุลาคม";
														break;
													case '11':
														$month = "พฤศจิกายน";
														break;
													case '12':
														$month = "ธันวาคม";
														break;
													default:
														# code...
														break;
												}
											@endphp			
											<h5>ข้อมูล ณ วันที่ {{$day}} {{$month}} {{$year}}</h5> </div>
									</div>
								</div>
								<table class="table funds_table table-bordered table-responsive-lg">
									<thead>
										<tr class="bg_orange">
											@if ($result[0]->StrFundShortName == 'EP-LTF')
												<th colspan="9" class="text-left"><a href="{{url('fundsepltf')}}">กองทุนเปิดเอคควิตี้โปร หุ้นระยะยาว</a></th>	
											@else
												<th colspan="9" class="text-left"><a href="{{url('fundsepltf')}}">กองทุนเปิดโซลาริสตราสารทุนเพื่อการเลี้ยงชีพ</a></th>	
											@endif
										</tr>
										<tr>
											<th scope="col">ชื่อย่อ</th>
											<th scope="col">วันที่</th>
											<th scope="col">มูลค่าทรัพย์สินสุทธิ</th>
											<th scope="col">มูลค่า NAV</th>
											<th scope="col">ราคาขาย</th>
											<th scope="col">ราคารับซื้อคืน</th>
											<th scope="col">เปลี่ยนแปลง (%)</th>
											<th scope="col">เปลี่ยนแปลง (บาท)</th>
											{{-- <th scope="col">ดาวน์โหลด</th> --}}
										</tr>
									</thead>
									<tbody>
											@foreach ($result as $_result)
												@php
													$date = new DateTime($_result->DTENAVDATE);
													$newdate = $date->format('d/m/Y');												
												@endphp
													<tr>
														<th scope="row">{{$_result->StrFundShortName}}</th>													
															<td>{{$newdate}}</td>
															<td>{{number_format($_result->DECNAV,2)}}</td>
															<td>{{number_format($_result->DECNAV_UNIT,2,'.','')}} </td>
														@if ($_result->DECPURCHASE == null)
															<td>N/A</td>
														@else
															<td>{{number_format($_result->DECPURCHASE,2,'.','')}} </td>
														@endif
														
														@if ($_result->DECREDEEM == null)
															<td>N/A</td>
														@else
															<td>{{number_format($_result->DECREDEEM,2,'.','')}} </td>
														@endif
														@php
															$bath = $_result->DACNAVLAST - $_result->DACNAVBEFOR;
															$percent = ($bath*100)/100;
														@endphp
														
														<td><span class="greentext"><b>{{number_format($percent,2,'.','')}}</b></span></td>
														

														<td><span class="greentext"><b>{{number_format($bath,2,'.','')}}</b></span></td>
													</tr>
											@endforeach
										{{-- <tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b>
											</span> </td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr>
										<tr>
											<th scope="row">EP-LTF</th>
											<td>17-04-2019 </td>
											<td>21,465,598.92 </td>
											<td>18.7374 </td>
											<td>18.7374 </td>
											<td>19.0037 </td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><span class="greentext"><b>0.48</b></span></td>
											<td><a href="#"><i class="far fa-file-excel"></i></a></td>
										</tr> --}}
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		
				</div>
			</div>
	</div>
		</main>
		@include('inc_footer')
			<script type="text/javascript">
				$(document).ready(function () {
					$(".select-display-slide > li").click(function () {
						var rel = $(this).attr("rel");
						console.log(rel);
						$('.display-slide').hide();
						$('.display-slide[rel=' + rel + ']').fadeIn();
						$(".select-display-slide > li").removeClass("active");
						$(this).addClass("active");
					});
				});
			</script>
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
				function getFund(selectObject) {
						var fund = selectObject.value;  
						
						if(fund){
							window.location = "{{url("/fundsprice/selectfund/")}}/"+fund;
						}
						
					}
			</script>
			<script>
				$(document).ready(function () {
					$(function () {
						$('.datepicker').datepicker({
							dateFormat: 'dd/mm/yy'
							, showButtonPanel: false
							, changeMonth: false
							, changeYear: false
							, inline: true
						});
					});
					$.datepicker.regional['es'] = {
						closeText: 'Cerrar'
						, prevText: '<Ant'
						, nextText: 'Sig>'
						, currentText: 'Hoy'
						, monthNames: ['January', 'Februaly', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
						, monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
						, dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Sathurday']
						, dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat']
						, dayNamesMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']
						, weekHeader: 'Sm'
						, dateFormat: 'dd/mm/yy'
						, firstDay: 1
						, isRTL: false
						, showMonthAfterYear: false
						, yearSuffix: ''
					};
					$.datepicker.setDefaults($.datepicker.regional['es']);
				});
			</script>
</body>

</html>