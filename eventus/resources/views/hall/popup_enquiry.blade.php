<script>
function submit_enquiry()
{
	$("#form-enquiry").validate({
		errorPlacement: function(){
            return false;
        },
        submitHandler:function(){
        		setEnquiry();
        	},    
});
	
}	
</script>

        <form class="form-enquiry login clearfix" id="form-enquiry" name="form-enquiry" method="post" action="" onsubmit="return false;">
        
            <div class="col-md-12 m-b-15 form-group">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label for="content">Message<span>*</span></label>                        
						<textarea class="form-control required" name="message" id="message"></textarea> 
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-6 m-b-35">
            	<input type="hidden" value="{{ $data['hallDetails']->hall_id }}" name="hall_id" id="hall_id">
            	<input type="hidden" value="{{ $data['hallDetails']->user_id }}" name="to_user_id" id="to_user_id">
                <input type="submit" class="btn btn-primary orange" value="Send" onclick="submit_enquiry();">
                <span class="enquiry-loader" style="display: none;">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
            </div>                       
        </form>