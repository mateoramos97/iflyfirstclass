<?php
use \yii\helpers\Url;

use app\components\widgets\custom\LandingHeaderMenu;

$path_logo =  Url::base().'/design/iffc-logo.svg';
$path_icons =  Url::base().'/design/icons/';
?>
<header id="header-wrapper" class="header-wrapper container px-14 mx-auto">
	<div class="m-auto xl:flex hidden justify-between items-end pt-2">
		<div class="contact-btn flex items-center h-12 bg-secondary rounded-2xl px-4 relative cursor-pointer">
			<img src="/public/img/phone.svg" width="20" height="20" alt="phone-icon">
			<div class="h-8 w-px bg-black bg-opacity-10 mx-4"></div>
			<div class="flex items-center gap-2">
				<span class="text-sm">Contact</span>
				<i class="icon-chevron text-ns"></i>
			</div>
			<div class="contact-form absolute min-w-80 bg-white top-0 left-0 shadow rounded-xl p-2">
				<div class="p-4 flex flex-col items-center">
					<p class="font-gilroy-bold text-2xl text-center">Contacts</p>
					<p class="font-gilroy-semibold mt-8 p-4 bg-hover rounded-r-2xl rounded-tl-2xl rounded-bl-lg w-fit">Call for exclusive deals! 😎</p>
					<div class="mt-2 flex items-center">
						<img class="scale-105" src="/public/img/phone-operator.svg" alt="operator-icon" width="40" height="40">
						<p class="font-gilroy-semibold text-xl px-4 py-3 ml-2 bg-hover rounded-r-2xl rounded-tl-lg rounded-bl-2xl">
							<a href="tel:+18883477817"><span class="text-orange">+1</span> <span class="font-semibold ml-2 pr-4">888 347 7817</span></a>
						</p>
					</div>
					<p class="text-mute my-6">or</p>
					<button
							class="btn btn-primary tools-ringme-ringmeLink form-action-button justify-center items-center w-full"
							id="tools-ringme-ringmeLink"
							data-test-automation-id="ringmeLink"
							tabindex="0"
							role="button"
							type="button"
							onclick='setTimeout(() => window.open("https://service.ringcentral.com/ringme/?uc=BD5DE3D086F9F9B2ABA3DC248F54530E5783399000016,0,,1,0&s=no&v=2&s_=1210", "Callback_RingMe", "resizable=no,width=500,height=635"), 0);return false;'>
					<span class="flex w-full items-center">
						<i class="icon-phone-ring text-lg"></i>
						<span class="grow">RingMe</span>
					</span>
					</button>
				</div>
				<hr class="my-2">
				<div class="p-4">
					<p class="font-semibold text-gray">Social media</p>
					<div class="mt-4">
						<div class="flex items-center justify-between">
							<a class="flex items-center" rel="nofollow" href="https://www.facebook.com/pages/I-Fly-First-Class/350113835017059" onMouseOver="document.getElementById('imgSocialFB').src='<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>';" onMouseOut="document.getElementById('imgSocialFB').src='<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>';">
								<img src="<?= $path_icons . 'facebook_button_link_to_fb.svg' ?>" id="imgSocialFB" alt="facebook" width="33" height="33"><span class="ml-3 font-semibold">Facebook</span>
							</a>
							<iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FI-Fly-First-Class%2F350113835017059&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;locale=en_US" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div itemscope="" itemtype="http://schema.org/Organization" id="logo" class="logo">
			<a itemprop="url" href="<?= Url::home(true); ?>" >
				<img src="/public/img/logo.svg" itemprop="logo" alt="" width="237" height="57">
			</a>
		</div>
		<div class="flex gap-2 items-center">
			<img src="/public/img/based-company.svg" width="104" height="29">
		</div>
	</div>
	<div class="main-nav xl:block hidden pt-8 pb-5 bg-white top-0 left-0 w-full items-center justify-center">
		<div class="flex items-center justify-center justify-items-center">
			<div class="main-nav-logo flex justify-center">
				<img class="scale-75"  src="/public/img/logo-2.svg" width="237" height="57">
			</div>
			<ul class="flex items-center justify-center gap-6">
				<li>
					<span id="menu-service" data-menu="menu-service"
						  class="link dropdown <?php echo in_array($this->context->route, [
								  'service/first-class', 'service/business-class', 'service/hotel'
						  ]) ? 'menu current-page' : 'menu'; ?>"
					>
						Services
						<i class="icon-chevron text-ns"></i>
					</span>
				</li>
				<li>
					<a href="<?= Url::to(['static-page/last-minute-deals']); ?>"
					   class="link <?php echo $this->context->route == 'static-page/last-minute-deals' ? 'current-page' : ''; ?>">
						Last minute deals
					</a>
				</li>
				<li>
					<a href="<?= Url::to(['static-page/corporate-account']); ?>"
					   class="link <?php echo $this->context->route == 'static-page/corporate-account' ? 'current-page' : ''; ?>">
						Corporate accounts
					</a>
				</li>
				<li>
					<a href="<?= Url::to(['blog/list']); ?>"
					   class="<?php echo $this->context->route == 'blog/list' ? 'current-page' : ''; ?>">
						Blog
					</a>
				</li>
				<li>
					<a href="<?= Url::to(['travel-tips/list']); ?>"
					   class="link <?php echo $this->context->route == 'travel-tips/list' ? 'current-page' : ''; ?>">
						Travel Tips
					</a>
				</li>
				<li>
					<a href="<?= Url::to(['static-page/about']); ?>"
					   class="link <?php echo $this->context->route == 'static-page/about' ? 'current-page' : ''; ?>">
						About Us
					</a>
				</li>
				<li>
				<span id="menu-cc" class="menu link dropdown" data-menu="menu-cc">
					Destination
					<i class="icon-chevron text-ns"></i>
				</span>
				</li>
			</ul>
		</div>
		<div class="menu-sub-wrapper">
			<div id="menu-service-sub" class="menu-sub" data-menu="menu-service">
				<div class="menu-content container-wrapper box-border">
					<ul class="flex flex-row gap-10">
						<li>
							<a href="<?= Url::to(['service/first-class']); ?>">First Class</a>
						</li>
						<li>
							<a href="<?= Url::to(['service/business-class']); ?>">Business Class</a>
						</li>
						<li>
							<a href="<?= Url::to(['service/hotel']); ?>">Hotels</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="menu-tools-sub" class="menu-sub" data-menu="menu-tools">
				<div class="menu-content box-border">
					<ul class="flex flex-row">
						<li>
							<a href="<?= Url::to(['tools/flight-tracker']); ?>">
								Flight Tracker
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['tools/visa']); ?>">
								Visa
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['tools/request-quote']); ?>">
								Request Quote
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="menu-cc-sub" class="menu-sub menu-cc-sub" data-menu="menu-cc">
				<div class="p-10 box-border flex justify-center">
					<?= LandingHeaderMenu::widget() ?>
				</div>
			</div>
		</div>
	</div>
</header>