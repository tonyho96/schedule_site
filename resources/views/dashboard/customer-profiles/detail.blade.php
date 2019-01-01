@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
<div class="container-fluid" style="margin: -30px -15px 0px -15px;">
	<div class="row">
		<div class="col-md-3 col-sm-4 border-float-right">
			<h2 class="page-title">Client</h2>
			<p class="description">
				{{$customer->first_name}} {{$customer->last_name}}<br>
				<i class="fa fa-mobile-phone"></i> {{ $customer->home_phone }} <br>
				<i class="fa fa-mobile-phone"></i> {{ $customer->mobile_phone }} <br>
				<i class="fa fa-mobile-phone"></i> {{ $customer->work_phone }}
			</p>
			<ul id="client-detail-nav-stacked" class="nav nav-pills nav-stacked">
				<li class="active">
					<a data-toggle="tab" href="#client-detail"><i class="fa fa-search">
						</i>&nbsp;{{$customer->first_name}} {{$customer->last_name}}
						<span class="badge badge-info pull-right">{{ $pet['count'] }} pets</span>
					</a>
				</li>
				<!-- PETS LOOP  -->
					@foreach( $pet['datas'] as $pet_item )
						<li>
							<a data-toggle="tab" href="#pet-{{ $pet_item->id }}">
								<i class="fa fa-paw"></i>&nbsp;{{ $pet_item->name }}
								<span class="badge badge-primary pull-right">{{ $pet_item->breed->name }}</span>
							</a>
						</li>
					@endforeach
				<!-- END PETS LOOP -->
				<li>
					<a data-toggle="tab" href="#new-pet">
						<i class="fa fa-plus"></i>&nbsp;Add pet<span class="badge badge-success pull-right"><i class="fa fa-paw"></i> Add</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="col-md-9 col-sm-8">
			<div class="tab-content" style="background-color: #ffffff; padding: 0px; margin: 0px -15px;">
				<div id="client-detail" class="tab-pane fade in active">
					<form action="{{route('edit-customer')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
						{{ csrf_field()}}
						<input type="hidden" name="customer_id" value="{{ $customer->id }}" >
						<div class="panel panel-default" style="margin-bottom: 0px;">
							<div class="panel-heading" style="border: 0px;">
								<h1 class="lighter-text">{{ $customer->first_name }}&nbsp;{{ $customer->last_name }}</h1>
								<div class="btn-group">
									<a href="{{route('create')}}" class="btn btn-primary btn-sm" id="navLeft" title="New client"><i class="fa fa-plus"></i></a>
									<button type="button" class="btn btn-primary btn-sm md-trigger" id="btnAlert" title="Edit Alert"><i class=" fa fa-bell"></i></button>
									<button type="submit" class="btn btn-primary btn-sm" id="openerCal" title="Save client"><i class="fa fa-save"></i> Save</button>
									<a href="{{route('search')}}" class="btn btn-primary btn-sm delete-customer" id="navRight" title="Delete client" data-id="{{$customer->id}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash-o"></i></a>
									<button type="button" class="btn btn-primary btn-sm" id="printClientRecord" title="Print Client"><i class="fa fa-print"></i></button>
								</div>
							</div>
							<div class="panel-body" style="padding: 15px 0px 0px;">
								<ul class="nav nav-tabs" style="background-color: #F6F6F6;">
									<li class="active"><a data-toggle="tab" href="#details"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Details</a></li>
									<li><a data-toggle="tab" href="#notes"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;Notes</a></li>
									<li><a data-toggle="tab" href="#appointments"><i class="fa fa-calendar-o"></i>&nbsp;Appointments</a></li>
								</ul>
								<div class="tab-content" style="border: 1px solid #ddd; border-top: 0px; padding: 0px 15px;">
									<div id="details" class="tab-pane fade in active">
										<br/><br/>
										<div class="form-group">
											<label for="first-name" class="col-md-2 col-sm-3 control-label">First name:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="first-name" name="first_name" value="{{ $customer->first_name }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="last-name" class="col-md-2 col-sm-3 control-label">Last name:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="last-name" name="last_name" value="{{ $customer->last_name }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="home-tel" class="col-md-2 col-sm-3 control-label">Home Tel:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="home-tel" name="home_phone" value="{{ $customer->home_phone }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="mobile-tel" class="col-md-2 col-sm-3 control-label">Mobile Tel:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="mobile-tel" name="mobile_phone" value="{{ $customer->mobile_phone }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="work-tel" class="col-md-2 col-sm-3 control-label">Work Tel:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="work-tel" name="work_phone" value="{{ $customer->work_phone }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="col-md-2 col-sm-3 control-label">Email:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="address1" class="col-md-2 col-sm-3 control-label">Address:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}" style="margin-bottom: 15px;" />
												<input type="text" class="form-control" id="address2" name="address2" value="{{ $customer->address2 }}" style="margin-bottom: 15px;" />

											</div>
										</div>
										<div class="form-group">
											<label for="town" class="col-md-2 col-sm-3 control-label">Town:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="town" name="town" value="{{ $customer->town }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="country-state" class="col-md-2 col-sm-3 control-label">Country\State:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="country-state" name="country_state" value="{{ $customer->country_state }}"/>
											</div>
										</div>
										<div class="form-group">
											<label for="post-zip-code" class="col-md-2 col-sm-3 control-label">Post\Zip code:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="post-zip-code" name="post_zip_code" value="{{ $customer->home_phone }}"/value="{{ $customer->post_zip_code }}">
											</div>
										</div>
									</div>
									<div id="notes" class="tab-pane fade">
										<br/><br/>
										<div class="form-group">
											<label for="notes" class="col-md-2 col-sm-3 control-label">Notes:</label>
											<div class="col-md-10 col-sm-9">
												<textarea class="form-control" id="notes" name="notes" rows="8">{{ $customer->note }}</textarea>
											</div>
										</div>
									</div>
									<div id="appointments" class="tab-pane fade">
										<br/><br/>
										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th class="normal-text">Pet</th>
														<th class="normal-text">Date</th>
														<th class="normal-text">Time</th>
														<th class="normal-text">Status1</th>
														<th class="normal-text">Status2</th>
														<th class="normal-text">Created</th>
														<th class="normal-text">View</th>
													</tr>
												</thead>
												<tbody>
													@foreach($pet['datas'] as $pet_item)
														@if($pet_item->customer_id == $customer->id)
															@foreach($appointments as $appointment)
																@if ($pet_item->id == $appointment->pet_id)
																	<tr>
																		<td>{{ $pet_item->name }}</td>
																		<td>{{ $appointment->start_date }}</td>
																		<td>{{ $appointment->start_time }}</td>
																		<td>{{ $appointment->status_1 }}</td>
																		<td>{{ $appointment->status_2 }}</td>
																		<td>{{ $appointment->created_at }}</td>
																		<td>View</td>
																	</tr>
																@endif
															@endforeach
														@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- PETS LOOP  -->
					@foreach( $pet['datas'] as $pet_item )
						<div id="pet-{{ $pet_item->id }}" class="tab-pane fade">
							<form action="{{ route('edit-pet') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
								{{ csrf_field() }}
								<input type="hidden" name="pet_id" value="{{$pet_item->id}}">
								<input type="hidden" name="customer_id" value="{{$customer->id}}">
								<div class="panel panel-default" style="margin-bottom: 0px;">
									<div class="panel-heading" style="border: 0px;">
										<h1 class="lighter-text">{{$pet_item->name}}</h1>
										<div class="btn-group">
											<div class="btn-group">
											<button type="submit" class="btn btn-primary btn-sm" id="openerCal" title="Save client"><i class="fa fa-save"></i>Save</button>
											<a href="{{route('detail', ['id' => $customer->id])}}" class="btn btn-primary btn-sm delete-pet" id="navRight" title="Delete pet" data-id="{{$pet_item->id}}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash-o"></i></a>
										</div>
										</div>
									</div>

									<div class="panel-body" style="padding: 15px 0px 0px;">
										<ul class="nav nav-tabs" style="background-color: #F6F6F6;">
											<li class="active"><a data-toggle="tab" href="#pet-{{ $pet_item->id }}-details"><i class="fa fa-paw"></i>&nbsp;Details</a></li>
											<li><a data-toggle="tab" href="#pet-{{ $pet_item->id }}-photo"><i class="fa fa-picture-o"></i>&nbsp;Photo</a></li>
											<li><a data-toggle="tab" href="#pet-{{ $pet_item->id }}-notes"><i class="fa fa-file-o"></i>&nbsp;Notes</a></li>
											<li><a data-toggle="tab" href="#pet-{{ $pet_item->id }}-appointments"><i class="fa fa-calendar-o"></i>&nbsp;Appointments</a></li>
											<li><a data-toggle="tab" href="#pet-{{ $pet_item->id }}-vet"><i class="fa fa-heartbeat"></i>&nbsp;Vet</a></li>
											<li><a data-toggle="tab" href="#pet-{{ $pet_item->id }}-contact"><i class="fa fa-life-ring"></i>&nbsp;Alternative Contact</a></li>
										</ul>

										<div class="tab-content" style="border: 1px solid #ddd; border-top: 0px; padding: 0px 15px;">

											<div id="pet-{{ $pet_item->id }}-details" class="tab-pane fade in active">
												<br/><br/>

												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-name" class="col-md-2 col-sm-3 control-label">Name:</label>
													<div class="col-md-10 col-sm-9">
														<input type="text" class="form-control" id="pet-{{ $pet_item->id }}-name" name="name" placeholder="insert pet name" value="{{ $pet_item->name }}"  required/>
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-breed" class="col-md-2 col-sm-3 control-label">Breed:</label>
													<div class="col-md-10 col-sm-9">
														<select class="form-control" name="breed_id" id="breed_id">
															@foreach($breeds as $breed)
																<option {{ $pet_item->breed_id == $breed->id ? 'selected' : '' }} value="{{ $breed->id }}">{{ $breed->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-dob" class="col-md-2 col-sm-3 control-label">D.O.B:</label>
													<div class="col-md-10 col-sm-9">
														<div class="input-group">
															<input type="text" id="pet-dob" name="dob" class="form-control datepicker" readonly="readonly" value="{{ $pet_item->dob }}">
															<div class="input-group-btn">
																<button class="btn btn-primary" type="button">
																<i class="fa fa-th" aria-hidden="true"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-gender" class="col-md-2 col-sm-3 control-label">Gender:</label>
													<div class="col-md-10 col-sm-9">
														<select class="form-control" name="gender" id="pet-{{ $pet_item->id }}-gender">
															<option value="">Unknown</option>
															<option value="male" {{ $pet_item->gender == 'male' ? 'selected' : '' }}>Male</option>
															<option value="female" {{ $pet_item->gender == 'female' ? 'selected' : '' }}>Female</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-neutered" class="col-md-2 col-sm-3 control-label">Neutered:</label>
													<div class="col-md-10 col-sm-9">
														<select class="form-control" name="is_neutered" id="pet-{{ $pet_item->id }}-neutered">
															<option value="">Unknown</option>
															<option value="1" {{ $pet_item->is_neutered == '1' ? 'selected' : '' }}>Yes</option>
															<option value="0" {{ $pet_item->is_neutered == '0' ? 'selected' : '' }}>No</option>
														</select>
													</div>
												</div>

											</div>

											<div id="pet-{{ $pet_item->id }}-photo" class="tab-pane fade">
												<br/><br/>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-image" class="col-md-2 col-sm-3 control-label">Image:</label>
													<div class="col-md-10 col-sm-9">
														<input type="file" id="pet-{{ $pet_item->id }}-image" name="pet_image" />
														<small>( MAX 1MB, JPG, GIF, PNG format, displayed as 400x400 )</small>
													</div>
												</div>

												<img src="{{ asset($pet_item->image_url) }}" width="400" height="400" />
												<br/><br/>
											</div>

											<div id="pet-{{ $pet_item->id }}-notes" class="tab-pane fade">
												<br/><br/>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-notes" class="col-md-2 col-sm-3 control-label">Notes:</label>
													<div class="col-md-10 col-sm-9">
														<textarea class="form-control" id="pet-{{ $pet_item->id }}-notes" name="pet_note" rows="6">{{ $pet_item->note }}</textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-cut-notes" class="col-md-2 col-sm-3 control-label">Cut Notes:</label>
													<div class="col-md-10 col-sm-9">
														<textarea class="form-control" id="pet-{{ $pet_item->id }}-cut-notes" name="pet_cut_note" rows="6">{{ $pet_item->cut_note }}</textarea>
													</div>
												</div>
											</div>

											<div id="pet-{{ $pet_item->id }}-appointments" class="tab-pane fade">
												<br/><br/>
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th class="normal-text">Date</th>
																<th class="normal-text">Time</th>
																<th class="normal-text">Resource</th>
																<th class="normal-text">Notes</th>
																<th class="normal-text">Status1</th>
																<th class="normal-text">Status2</th>
																<th class="normal-text">Created</th>
																<th class="normal-text">View</th>
															</tr>
														</thead>
														<tbody>
														@foreach($appointments as $appointment)
															@if ($pet_item->id == $appointment->pet_id)
															<tr>
																<td>{{ $appointment->start_date }}</td>
																<td>{{ $appointment->start_time }}</td>
																<td>
																@foreach ($groomers as $groomer)
																	@if ($groomer->id == $appointment->groomer_id)
                                                                            {{ $groomer->first_name }} {{ $groomer->last_name }}
																		@break
																	@endif
																@endforeach</td>
																<td>{{ $appointment->notes }}</td>
																<td>{{ $appointment->status_1 }}</td>
																<td>{{ $appointment->status_2 }}</td>
																<td>{{ $appointment->created_at }}</td>
																<td>View</td>
															</tr>
															@endif
														@endforeach
														</tbody>
													</table>
												</div>
											</div>

											<div id="pet-{{ $pet_item->id }}-vet" class="tab-pane fade">
												<br/><br/>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-vet-name" class="col-md-2 col-sm-3 control-label">Name:</label>
													<div class="col-md-10 col-sm-9">
														<input type="text" class="form-control" id="pet-{{ $pet_item->id }}-vet-name" name="vet_name" value="{{ $pet_item->vet_name }}" />
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-vet-number" class="col-md-2 col-sm-3 control-label">Number:</label>
													<div class="col-md-10 col-sm-9">
														<input type="number" class="form-control" id="pet-{{ $pet_item->id }}-vet-number" name="vet_number" value="{{ $pet_item->vet_number }}" />
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-vet-address" class="col-md-2 col-sm-3 control-label">Address:</label>
													<div class="col-md-10 col-sm-9">
														<textarea class="form-control" id="pet-{{ $pet_item->id }}-vet-address" name="vet_address" rows="6">{{ $pet_item->vet_address }}</textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-vet-notes" class="col-md-2 col-sm-3 control-label">Medical Notes:</label>
													<div class="col-md-10 col-sm-9">
														<textarea class="form-control" id="pet-{{ $pet_item->id }}-vet-notes" name="vet_medical_note" rows="6">{{ $pet_item->vet_medical_note }}</textarea>
													</div>
												</div>
											</div>

											<div id="pet-{{ $pet_item->id }}-contact" class="tab-pane fade">
												<br/><br/>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-contact-name" class="col-md-2 col-sm-3 control-label">Name:</label>
													<div class="col-md-10 col-sm-9">
														<input type="text" class="form-control" id="pet-{{ $pet_item->id }}-contact-name" name="alternative_contact_name" value="{{ $pet_item->alternative_contact_name }}" />
													</div>
												</div>
												<div class="form-group">
													<label for="pet-{{ $pet_item->id }}-contact-number" class="col-md-2 col-sm-3 control-label">Number:</label>
													<div class="col-md-10 col-sm-9">
														<input type="number" class="form-control" id="pet-{{ $pet_item->id }}-contact-number" name="alternative_contact_number" value="{{ $pet_item->alternative_contact_number }}" />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					@endforeach
				<!-- END PETS LOOP -->
				<div id="new-pet" class="tab-pane fade">
					<form action="{{ route('savepet') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
						{{ csrf_field() }}
						<input type="hidden" name="customer_id" value="{{$customer->id}}">
						<div class="panel panel-default" style="margin-bottom: 0px;">
							<div class="panel-heading" style="border: 0px;">
								<h1 class="lighter-text">New Pet</h1>
								<div class="btn-group">
									<button type="submit" class="btn btn-primary btn-sm" id="openerCal" title="Save client"><i class="fa fa-save"></i> Save</button>
								</div>
							</div>
							<div class="panel-body" style="padding: 15px 0px 0px;">
								<ul class="nav nav-tabs" style="background-color: #F6F6F6;">
									<li class="active"><a data-toggle="tab" href="#pet-details">Details</a></li>
									<li><a data-toggle="tab" href="#pet-notes">Notes</a></li>
									<li><a data-toggle="tab" href="#pet-vet">Vet</a></li>
									<li><a data-toggle="tab" href="#pet-contact">Alternative Contact</a></li>
								</ul>
								<div class="tab-content" style="border: 1px solid #ddd; border-top: 0px; padding: 0px 15px;">
									<div id="pet-details" class="tab-pane fade in active">
										<br/><br/>

										<div class="form-group">
											<label for="pet-name" class="col-md-2 col-sm-3 control-label">Name:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="pet-name" name="name" placeholder="insert pet name" required />
											</div>
										</div>
										{{-- SCS-43 --}}
										<div class="form-group">
											<label for="pet-breed" class="col-md-2 col-sm-3 control-label">Breed:</label>
											<div class="col-md-10 col-sm-9">
												<select class="form-control" name="breed_id" id="breed_id">
													@foreach($breeds as $breed)
														<option value="{{ $breed->id }}">{{ $breed->name }}</option>
													@endforeach
												</select>
											</div>
										</div>


										<div class="form-group">
											<label for="pet-dob" class="col-md-2 col-sm-3 control-label">D.O.B:</label>
											<div class="col-md-10 col-sm-9">
												<div class="input-group">
													<input type="text" id="pet-dob" name="dob" class="form-control datepicker " readonly="readonly">
													<div class="input-group-btn">
														<button class="btn btn-primary" type="button">
														<i class="fa fa-th" aria-hidden="true"></i>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="pet-gender" class="col-md-2 col-sm-3 control-label">Gender:</label>
											<div class="col-md-10 col-sm-9">
												<select class="form-control" name="gender" id="pet-gender">
													<option value="">Unknown</option>
													<option value="male">Male</option>
													<option value="female">Female</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="pet-neutered" class="col-md-2 col-sm-3 control-label">Neutered:</label>
											<div class="col-md-10 col-sm-9">
												<select class="form-control" name="is_neutered" id="neutered">
													<option value="">Unknown</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="pet-image" class="col-md-2 col-sm-3 control-label">Image:</label>
											<div class="col-md-10 col-sm-9">
												<input type="file" id="pet-image" name="pet_image" />
												<small>( MAX 1MB, JPG, GIF, PNG format, displayed as 400x400 )</small>
											</div>
										</div>
									</div>
									<div id="pet-notes" class="tab-pane fade">
										<br/><br/>
										<div class="form-group">
											<label for="pet-notes" class="col-md-2 col-sm-3 control-label">Notes:</label>
											<div class="col-md-10 col-sm-9">
												<textarea class="form-control" id="pet-notes" name="pet_note" rows="6"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="pet-cut-notes" class="col-md-2 col-sm-3 control-label">Cut Notes:</label>
											<div class="col-md-10 col-sm-9">
												<textarea class="form-control" id="pet-cut-notes" name="pet_cut_note" rows="6"></textarea>
											</div>
										</div>
									</div>
									<div id="pet-vet" class="tab-pane fade">
										<br/><br/>
										<div class="form-group">
											<label for="pet-vet-name" class="col-md-2 col-sm-3 control-label">Name:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="pet-vet-name" name="vet_name" />
											</div>
										</div>
										<div class="form-group">
											<label for="pet-vet-number" class="col-md-2 col-sm-3 control-label">Number:</label>
											<div class="col-md-10 col-sm-9">
												<input type="number" class="form-control" id="pet-vet-number" name="vet_number" />
											</div>
										</div>
										<div class="form-group">
											<label for="pet-vet-address" class="col-md-2 col-sm-3 control-label">Address:</label>
											<div class="col-md-10 col-sm-9">
												<textarea class="form-control" id="pet-vet-address" name="vet_address" rows="6"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="pet-vet-notes" class="col-md-2 col-sm-3 control-label">Medical Notes:</label>
											<div class="col-md-10 col-sm-9">
												<textarea class="form-control" id="pet-vet-notes" name="vet_medical_note" rows="6"></textarea>
											</div>
										</div>
									</div>
									<div id="pet-contact" class="tab-pane fade">
										<br/><br/>
										<div class="form-group">
											<label for="pet-contact-name" class="col-md-2 col-sm-3 control-label">Name:</label>
											<div class="col-md-10 col-sm-9">
												<input type="text" class="form-control" id="alternative_contact_name" name="alternative_contact_name" />
											</div>
										</div>
										<div class="form-group">
											<label for="pet-contact-number" class="col-md-2 col-sm-3 control-label">Number:</label>
											<div class="col-md-10 col-sm-9">
												<input type="number" class="form-control" id="pet-contact-number" name="alternative_contact_number" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop