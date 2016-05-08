<script type="text/javascript">
    $(document).ready(function () {
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
	    $(".list-g a").click(function(event) {
        event.preventDefault();
        $(this).addClass("current");
        $(this).siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).slideDown('slow');
   });
 });
</script>
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="#">homepage></a></li>
    <li>No Listing</li>
  </ul>
<h1>There are no listing</h1>
<a href="<?php echo JEWISH_URL;?>/classified/">Go Back</a>
 </article>
</div>