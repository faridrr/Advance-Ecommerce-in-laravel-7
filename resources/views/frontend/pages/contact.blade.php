@extends('frontend.layouts.master')

@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
                            <li><a href="/">Accueil<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									@php
										$settings=DB::table('settings')->get();
									@endphp
									<h4>Entrer en contact</h4>
									<h3>Écrivez-nous un message @auth @else<span style="font-size:12px;" class="text-danger">[You need to login first]</span>@endauth</h3>
								</div>
								<form class="form-contact form contact_form" method="post" action="{{route('contact.store')}}" id="contactForm" novalidate="novalidate">
									@csrf
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Votre Nom<span>*</span></label>
												<input name="name" id="name" type="text" placeholder="Entrez votre nom">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Votre sujets<span>*</span></label>
												<input name="subject" type="text" id="subject" placeholder="Entrez le sujet">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Votre Email<span>*</span></label>
												<input name="email" type="email" id="email" placeholder="Entrez votre email">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Téléphone<span>*</span></label>
												<input id="phone" name="phone" type="number" placeholder="Entrez votre téléphone">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group message">
												<label>Votre Message<span>*</span></label>
												<textarea name="message" id="message" cols="30" rows="9" placeholder="Entrer le message"></textarea>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn ">Envoyer le message</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="single-info">
									<i class="fa fa-phone"></i>
									<h4 class="title">Appelez-nous:</h4>
									<ul>
										<li>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-envelope-open"></i>
									<h4 class="title">Email:</h4>
									<ul>
										<li><a href="mailto:info@yourwebsite.com">@foreach($settings as $data) {{$data->email}} @endforeach</a></li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-location-arrow"></i>
									<h4 class="title">Notre adresse :</h4>
									<ul>
										<li>@foreach($settings as $data) {{$data->address}} @endforeach</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!--/ End Contact -->

	<!-- Map Section -->
	<div class="map-section">
		<div id="myMap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12793.11466472458!2d3.1885287!3d36.7158681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x67600f3e52385ddf!2sMichket!5e0!3m2!1sen!2sdz!4v1642804269319!5m2!1sen!2sdz" width="100%" height="100%" frameborder="0"  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</div>
	<!--/ End Map Section -->

	<!-- Start Shop Newsletter  -->
{{--	@include('frontend.layouts.newsletter')--}}
	<!-- End Shop Newsletter -->
	<!--================Contact Success  =================-->
	<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
				<h2 class="text-success">Merci!</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-success">Votre message a bien été envoyé...</p>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modals error -->
	<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
				<h2 class="text-warning">Pardon!</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-warning">Quelque chose s'est mal passé.</p>
			</div>
		  </div>
		</div>
	</div>
@endsection

@push('styles')
<style>
	.modal-dialog .modal-content .modal-header{
		position:initial;
		padding: 10px 20px;
		border-bottom: 1px solid #e9ecef;
	}
	.modal-dialog .modal-content .modal-body{
		height:100px;
		padding:10px 20px;
	}
	.modal-dialog .modal-content {
		width: 50%;
		border-radius: 0;
		margin: auto;
	}
</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush
