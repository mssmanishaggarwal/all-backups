
<section class="signupmain">
    <div class="container">
    	<div class="thank-you">
    	<h3>Hello {{$first_name}} {{$last_name}}</h3>
    	<h4>Please Complete your Registration by <a href="{{ url('/') }}complete-registration/{{$email_auth}}">by Clicking Here</a>  </h4>
    	</div>
    </div>
</section>
<style type="text/css">
	.thank-you{
		padding:200px 0 ;
	}
	.thank-you >h4{
		text-align: center;
	}
</style>
