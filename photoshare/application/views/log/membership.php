<script>
 $(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>/css/membership.css">
<article class="registration-page-wrap clearfix">
 <div class="m-pricing-tab-wrap clearfix">
  <div class="m-pricing-tab-inner clearfix">
    <div id="tabs-container">
      <ul class="tabs-menu">
        <li class="current"><a href="#tab-1">Standard</a></li>
        <li><a href="#tab-2">Professional</a></li>
      </ul>
      <div class="tab">
        <div id="tab-1" class="tab-content">




          <div class="pricing-table-wrap clearfix">



            <div class="pricing-table-block pricing-table-block-one">
              <h3>Trial</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>200 MB Free</h4>
                  <p class="m-bill-process">&nbsp;</p>
                  <p class="m-onboarding">&nbsp;</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">
                  <p>10% discount if billed annually.</p>
                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/standard-trial/" class="try-btn">Try</a></div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>




            <div class="pricing-table-block pricing-table-block-one">
              <h3>Starter</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>2 GB</h4>
                  <p class="m-bill-process">Billed Monthly</p>
                  <p class="m-onboarding">$5.99/month</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">

                  <p>10% discount if billed annually.</p>
                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/standard-starter/" class="buy-btn">Buy Now</a> </div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>




            <div class="pricing-table-block pricing-table-block-two">
              <h3>Economy</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>5 GB</h4>
                  <p class="m-bill-process">Billed Monthly</p>
                  <p class="m-onboarding">$10.99/month</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">

                  <p>10% discount if billed annually.</p>
                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/standard-economy/" class="buy-btn">Buy Now</a> </div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>




            <div class="pricing-table-block pricing-table-block-three">
              <h3>Preferred</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>7 GB</h4>
                  <p class="m-bill-process">Billed Monthly</p>
                  <p class="m-onboarding">$12.99/month</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">

                  <p>10% discount if billed annually.</p>
                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/standard-preferred/" class="buy-btn">Buy Now</a> </div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>




          </div>




        </div>
        <div id="tab-2" class="tab-content">
          <div class="pricing-table-wrap clearfix">




            <div class="pricing-table-block pricing-table-block-one">
              <h3>Basic</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>4 GB</h4>
                  <p class="m-bill-process">Billed Monthly</p>
                  <p class="m-onboarding">$9.99/month</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">
                  <div class="m-con-count"><span>500 MB</span> free with any plan </div>

                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/professional-basic/" class="buy-btn">Buy Now</a> </div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>





            <div class="pricing-table-block pricing-table-block-two">
              <h3>Plus</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>10 GB</h4>
                  <p class="m-bill-process">Billed Monthly</p>
                  <p class="m-onboarding">$20.99/month</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">
                  <div class="m-con-count"><span>500 MB</span> free with any plan </div>

                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/professional-plus/" class="buy-btn">Buy Now</a> </div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>





            <div class="pricing-table-block pricing-table-block-three">
              <h3>Premier</h3>
              <div class="gray-bg-sec clearfix">
                <div class="pricing-table-price-sec">
                  <h4>15 GB</h4>
                  <p class="m-bill-process">Billed Monthly</p>
                  <p class="m-onboarding">$25.99/month</p>
                </div>
                <div class="pricing-table-desc-sec">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
                <div class="pricing-table-con-count-sec">
                  <div class="m-con-count"><span>500 MB</span> free with any plan </div>

                  <div class="price-con-sec-btn-wrap clearfix"> <a href="<?php echo base_url();?>log/account/payProcess/professional-premier/" class="buy-btn">Buy Now</a> </div>
                </div>
              </div>
              <div class="pricing-table-features-sec">
                <ul class="clearfix">
                  <li>Content marketing</li>
                  <li>Email marketing</li>
                  <li>Social Media</li>
                  <li>Analytics</li>
                  <li><a href="#">See all features</a></li>
                </ul>
              </div>
            </div>





          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</article>

