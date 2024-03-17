<script setup>
import FacebookLogoSvg from "../icons/FacebookLogoSvg.vue";
import FacebookFollowSvg from "../icons/FacebookFollowSvg.vue";
import Logo2Svg from "../icons/Logo2Svg.vue";
import BbbSvg from "../icons/BbbSvg.vue";
import DbSvg from "../icons/DbSvg.vue";
import AstaSvg from "../icons/AstaSvg.vue";

const siteMap = [
  {
    title:'Home',
    href: ''
  },
  {
    title:'Corporate accounts',
    href: ''
  },
  {
    title:'Blog',
    href: ''
  },
  {
    title:'Testimonials',
    href: ''
  },
  {
    title:'About Us',
    href: ''
  },
  {
    title:'Sitemap',
    href: ''
  },
];

const services = [
  {
    title:'First class',
    href: ''
  },
  {
    title:'Business',
    href: ''
  },
  {
    title:'Hotels',
    href: ''
  },
];

const tools = [
  {
    title:'Flight tracker',
    href: ''
  },
  {
    title:'Visa',
    href: ''
  },
  {
    title:'Request quote',
    href: ''
  },
];

</script>
<template>
  <footer class="bg-grayBG px-[53px] h-[561px]">
    <div class="flex pt-[74px] mb-[88px] justify-between">
      <div>
        <p class="text-mainTextColor text-lg mb-7">Email Subscription</p>
        <p class="text-mainTextColor text-sm mb-11">Receive monthly cool ideas, inspiring stories, great reviews and offers</p>
        <div class="flex gap-2 items-center mb-12">
          <input 
            type="text" 
            class="w-[480px] rounded-[10px] h-14 pl-6 placeholder:text-black placeholder:opacity-50"
            placeholder="Your email address"
            >
          <button class="bg-mainTextColor text-white rounded-lg px-8 h-14 text-[15px]">Submit</button>
        </div>
        <div class="flex gap-6 items-center">
          <FacebookLogoSvg />
          <FacebookFollowSvg />
        </div>
      </div>
      <div class="flex gap-[120px] mr-[37px]">
        <div>
          <p class="text-[15px] mb-[40px]">Site Map</p>
          <ul>
            <li v-for="(item, index) in siteMap" :key="index" class="mb-5 last:mb-0">
              <a :href="item.href" class="text-mainTextColor text-xs">{{ item.title }}</a>
            </li>
          </ul>
        </div>
        <div>
          <p class="text-[15px] mb-[40px]">Services</p>
          <ul>
            <li v-for="(item, index) in services" :key="index" class="mb-5 last:mb-0">
              <a :href="item.href" class="text-mainTextColor text-xs">{{ item.title }}</a>
            </li>
          </ul>
        </div>
        <div>
          <p class="text-[15px] mb-[40px]">Tools</p>
          <ul>
            <li v-for="(item, index) in tools" :key="index" class="mb-5 last:mb-0">
              <a :href="item.href" class="text-mainTextColor text-xs">{{ item.title }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="h-px w-[100%] bg-black bg-opacity-10 m-auto mb-5"></div>
    <div class="flex justify-between items-center mb-[30px]">
      <Logo2Svg />
      <p class="text-xs text-mainTextColor text-opacity-55">© 2022 IFlyFirstClass. All rights Reserved. Registered in accordance to California State regulations # 2107775-40. Use of this Web site constitutes<br/> acceptance of the <span class="text-xs text-mainTextColor">Terms of Service</span> and Privacy Policy. Designated trademarks and brands are the property of their respective owners.</p>
      <div class="flex gap-8 items-center">
        <BbbSvg />
        <AstaSvg />
        <DbSvg />
      </div>
    </div>
  </footer>
</template>
<style scoped>
.text-white {
  color: white;
}
</style>
