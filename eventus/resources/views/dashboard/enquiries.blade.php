@extends('layouts.dashboard')
@section('script')
@endsection
@section('content')

<section class="dash-main clearfix">

	<div class="col-md-12 dash-top-second">
		<div class="col-md-6">
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_44')}}</h2>
			<ul>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
				<li><a href="{{ url('/dashboard/enquiries') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_44')}}</a></li>
			</ul>
		</div>
	</div>

<?php //print_r(getMessage());?>

	<div class="col-md-12 dash-container p-t-20 p-b-20">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" class="table table-hover enquiry table-bordered tabulardata mobile-grid message-listing" id="tech-companies-1">
				<thead>
					<tr>
						<th width="21%">{{ Sitevariable::setVariables($data['language_val'],'eventus_114')}}</th>
						<th width="35%">{{ Sitevariable::setVariables($data['language_val'],'eventus_115')}}</th>
						<th width="7%" class="text-center">{{ Sitevariable::setVariables($data['language_val'],'eventus_116')}}</th>
						<th width="7%" class="text-center">{{ Sitevariable::setVariables($data['language_val'],'eventus_117')}}</th>
						<th width="30%">{{ Sitevariable::setVariables($data['language_val'],'eventus_118')}}</th>

					</tr>
				</thead>
				<tbody>


@foreach (getMessage() as $key => $msg)
					<tr>
						<td><strong><a href="{{ url('/msr') }}/<?php echo $msg->msg_id; ?>">
						<?php echo (getUserName($msg->from_user_id)[0]->first_name) ?>
						<?php echo (getUserName($msg->from_user_id)[0]->last_name) ?></a>
						</strong><p class="text-muted small"><span class="fa fa-clock-o"></span>
						{{date('d M, Y h:m a',strtotime($msg->msg_datetime)) }}</p></td>
						<td>
							<strong><a href="{{ url('/msr') }}/<?php echo $msg->msg_id; ?>">
							     <?php echo (getHallName($msg->hall_id)[0]->hall_name) ?></a>
							</strong>
						<br>
							<br>
							<?php echo $msg->message ?></td>
							<td align="center">
								<?php echo (replyCount($msg->msg_id)[0]->cnt); ?>
								<span class="hidden-md hidden-lg">{{ Sitevariable::setVariables($data['language_val'],'eventus_116')}}</span>
							</td>
							<td align="center">
								<a class="btn btn-sm btn-default" href="{{ url('/msr') }}/<?php echo $msg->msg_id; ?>">

									<span class="fa fa-eye  text-muted">
									<?php if (notifyCountReply($msg->msg_id)[0]->cnt != 0) {?>
									<i class="count">
									<?php echo notifyCountReply($msg->msg_id)[0]->cnt; ?>
									</i>
									<?php }?>
									</span>
								</a>
							</td>
							<td>
								<div class="hidden-md hidden-lg"><strong>{{ Sitevariable::setVariables($data['language_val'],'eventus_118')}} :</strong></div>
								by <a href="mailto:<?php echo (getUserName($msg->from_user_id)[0]->email) ?>"><?php echo (getUserName($msg->from_user_id)[0]->email) ?></a><br>
								<span class="text-muted small">{{date('d M, Y h:m a',strtotime($msg->msg_datetime)) }}</span>

							</td>
					    </tr>
@endforeach
							<!-- <tr>
								<td><strong><a href="{{ url('/dashboard/single/enquiry') }}">Palash Roy</a></strong><p class="text-muted small"><span class="fa fa-clock-o"></span> Fri Mar 18, 2016 07:03 am</p></td>
								<td><strong><a href="{{ url('/dashboard/single/enquiry') }}">Test Advertisement - 1</a></strong><br>
									<em>Code: #RTBBFF2521</em><br>
									Hello  Dear...</td>
									<td align="center">
										3                            <span class="hidden-md hidden-lg">Replies</span>
									</td>
									<td align="center">
										<a class="btn btn-sm btn-default" href="{{ url('/dashboard/single/enquiry') }}">

											<span class="fa fa-eye  text-muted"></span>
										</a>
</td>
										<td>
											<div class="hidden-md hidden-lg"><strong>Last Post :</strong></div>
											by <a href="mailto:palash@gmail.com">palash@gmail.com</a><br>
											<span class="text-muted small">Fri Mar 18, 2016 07:03 am</span>

										</td>
									</tr> -->

								</tbody>
							</table>
						</div>
					</div>

				</section>
<?php make_read_parent_message();?>
				@endsection