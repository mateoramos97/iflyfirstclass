<script setup>
import LogoSvg from "../icons/LogoSvg.vue";
import USASvg from "../icons/USASvg.vue";
import PhoneSvg from "../icons/PhoneSvg.vue";
import ArrowDownSvg from "../icons/ArrowDownSvg.vue";
</script>
<template>
  <header class="bg-white px-14">
    <div class="m-auto flex justify-between items-end pt-2">
        <div class="flex items-center h-12 bg-grayContact rounded-2xl px-4">
          <PhoneSvg />
          <div class="h-8 w-px bg-black bg-opacity-10 mx-4"></div>
          <div class="flex items-center gap-2">
            <span class="text-[13px]">Contact</span>
            <ArrowDownSvg />
          </div>
        </div>
        <LogoSvg />
      <div class="flex gap-2 items-center">
        <div class="flex flex-col text-xs">
          <span class="text-black text-[12px]">US Based</span>
          <span class="text-black text-[12px]">Company</span>
        </div>
        <USASvg />
      </div>
    </div>
    <div class="mt-8 mb-5">
      <ul class="flex items-center justify-center gap-10">
        <li class="flex items-center gap-1.5">
          <a href="" class="text-xs">Services</a>
          <ArrowDownSvg />
        </li>
        <li>
          <a href="" class="text-xs">Last minute deals</a>
        </li>
        <li>
          <a href="" class="text-xs">Corporate acounts</a>
        </li>
        <li>
          <a href="" class="text-xs">Blog</a>
        </li>
        <li>
          <a href="" class="text-xs">Travel Tips</a>
        </li>
        <li>
          <a href="" class="text-xs">About Us</a>
        </li>
        <li class="flex items-center gap-1.5">
          <a href="">Destination</a>
          <ArrowDownSvg />
        </li>
      </ul>
    </div>

  </header>
</template>
<style></style>