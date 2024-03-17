<?php
use \yii\helpers\Url;

$path_icons =  Url::base().'/design/icons/';
?>
<footer class="bg-secondary xl:px-12 px-8 pt-20 border-t shadow-lg">
	<div class="container mx-auto">
		<div class="flex justify-between mb-20 gap-10 flex-wrap">
			<div>
				<h6 class="mb-4">Email Subscription</h6>
				<p class="text-sm mb-11">Receive monthly cool ideas, inspiring stories, great reviews and offers</p>
				<div class="subscription relative flex gap-2 items-center mb-12">
					<form action="" class="request-subscriber flex w-full">
						<input type="hidden" class="check-subscription-request-subscriber" name="check_subscription" value="">
						<input type="email" name="email" class="required rounded-lg py-4 px-8 mr-3 placeholder:text-mute xl:w-80 bg-white" required=""
								placeholder="Your email address"
						>
						<button type="submit" class="btn btn-primary">Submit</button>
						<div class="result border-box"></div>
					</form>
				</div>
				<div class="flex gap-6 items-center">
					<a rel="nofollow" href="https://www.facebook.com/pages/I-Fly-First-Class/350113835017059" onMouseOver="document.getElementById('imgSocialFB').src='<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>';" onMouseOut="document.getElementById('imgSocialFB').src='<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>';"><img src="<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>" id="imgSocialFB" alt="facebook"></a>
					<iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FI-Fly-First-Class%2F350113835017059&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;locale=en_US" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
				</div>
			</div>
			<div class="grid xl:grid-cols-3 grid-cols-2 gap-20 xl:gap-24">
				<div>
					<h6 class="mb-7">Site Map</h6>
					<ul class="flex flex-col gap-5">
						<li>
							<a href="/">Home</a>
						</li>
						<li>
							<a href="<?= Url::to(['static-page/corporate-account']); ?>">Corporate accounts</a>
						</li>
						<li>
							<a href="<?= Url::to(['blog/list']); ?>">Blog</a>
						</li>
						<li>
							<a href="<?= Url::to(['static-page/testimonials']); ?>">Testimonials</a>
						</li>
						<li>
							<a href="<?= Url::to(['static-page/about']); ?>">About Us</a>
						</li>
						<li>
							<!-- <a href="<?= Url::to(['site-map-page/index']); ?>">Sitemap</a> -->
							<a href="/sitemap.xml">Sitemap</a>
						</li>
					</ul>
				</div>
				<div>
					<h6 class="mb-7">Services</h6>
					<ul class="flex flex-col gap-5">
						<li>
							<a href="<?= Url::to(['service/first-class']); ?>">First class</a>
						</li>
						<li>
							<a href="<?= Url::to(['service/business-class']); ?>">Business</a>
						</li>
						<li>
							<a href="<?= Url::to(['service/hotel']); ?>">Hotels</a>
						</li>
					</ul>
				</div>
				<div>
					<h6 class="mb-7">Tools</h6>
					<ul class="flex flex-col gap-5">
						<li>
							<a href="<?= Url::to(['tools/flight-tracker']); ?>">Flight tracker</a>
						</li>
						<li>
							<a href="<?= Url::to(['tools/visa']); ?>">Visa</a>
						</li>
						<li>
							<a href="<?= Url::to(['tools/request-quote']); ?>">Request quote</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<hr class="pb-10">
		<div class="xl:flex hidden justify-between items-center pb-10">
			<div class="flex">
				<img src="/public/img/logo-2.svg">
				<p class="text-xs px-11 text-mute max-w-4xl">
					© 2022 IFlyFirstClass. All rights Reserved. Registered in accordance to California State regulations # 2107775-40. Use of this Web site constitutes acceptance of the <a href="javascript:void(0);" class="terms-conditions-link underline text-black" onclick="openTermsConditions(this)">Terms of Service</a> and Privacy Policy. Designated trademarks and brands are the property of their respective owners.
				</p>
				<?= $this->render('_footer-terms-conditions') ?>
			</div>
			<div class="flex gap-8 items-center">
				<div>
					<img src="/public/img/bbb.svg">
				</div>
				<div>
					<img src="/public/img/asta.svg">
				</div>
				<div>
					<img src="/public/img/db.svg">
				</div>
			</div>
		</div>
	</div>
</footer>