<script>
function submit_review()
{
	$("#form-review").validate({
		errorPlacement: function(){
            return false;
        },
        submitHandler:function(){
        		setReview();
        	},    
});
	
}	
</script>

        <form class="form-review login clearfix" id="form-review" name="form-review" method="post" action="" onsubmit="return false;">
        
        	<div class="hall_rating col-md-12 m-b-30">
                        	Your rating:
							<span class="star-rating">
							<input type="radio" value="1" name="rating"><i></i>
							<input type="radio" value="2" name="rating"><i></i>
							<input type="radio" value="3" name="rating"><i></i>
							<input type="radio" value="4" name="rating"><i></i>
							<input type="radio" value="5" name="rating"><i></i>
							</span>
            </div>
            
            <div class="col-md-12 m-b-15 form-group">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label for="content">Review text<span>*</span></label>                        
						<textarea class="form-control required" name="review_text" id="review_text"></textarea> 
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-9 m-b-35">
            	<input type="hidden" value="{{ $data['hallDetails']->hall_id }}" name="hall_id" id="hall_id">
                <input type="submit" class="btn btn-primary orange" value="Post" onclick="submit_review();">
                <span class="review-loader" style="display: none;">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
            </div>
                                
        </form>