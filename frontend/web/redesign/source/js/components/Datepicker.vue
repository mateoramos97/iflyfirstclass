<template>
    <fieldset class="relative" :data-uid="uid" v-click-outside="resetCalendarView">
        <input :name="name" :id="id" :placeholder="placeholder" :class="className"  :value="formattedResult"
               readonly
               @click="handleClick"
        >
        <div class="calendar shadow-lg" :class="{opened: showCalendar}" :style="{width:calendarWidth, left: calendarLeft}">
          <div class="pl-[24px] pr-[16px] py-[16px] flex justify-between items-center">
            <span class="text-xl font-gilroy-semibold">{{ placeholder }}</span>
            <i class="icon-x" @click="resetCalendarView"></i>
          </div>
          <hr>
          <div class="dates-wrapper" v-show="!showMonths">
            <div class="flex justify-between items-center pl-[12px] pr-[14px] h-[56px]">
              <div class="calendar-month-year" @click="showMonths = true">
                <span class="text-sm">{{ nameSelectedMonth }} {{ selectedDate.format('YYYY') }}</span><i class="icon-chevron text-ns ml-3"></i>
              </div>
              <div class="flex">
                <i class="month-arrow icon-arrow-left text-xs cursor-pointer" @click="previousMonth()"></i>
                <i class="month-arrow icon-arrow-right text-xs ml-2 cursor-pointer" @click="nextMonth()"></i>
              </div>
            </div>
            <div class="calendar-days pb-[12px] pt-[6px] px-[12px]">
              <div class="days weekdays">
                <span v-for="(day,index) in weekdays" :key="index" class="day">{{ day }}</span>
              </div>
              <div class="dates">
                <div v-for="(weeks,i) in dates" :key="i" class="days">
                  <span v-for="(day,j) in weeks" :key="j"
                        class="day"
                        :class="{today: isToday(day), disabled: isDisabled(day), selected: isSelected(day)}"
                        @click="selectDateHandler(day)"
                  >{{ day }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="months-years-wrapper" v-show="showMonths">
            <div class="months-years-header flex justify-between items-center h-[56px]">
              <div class="cursor-pointer flex items-center tab" :class="{active: activeTab === 'months'}" @click="activeTab = 'months'">
                <span class="text-sm">{{ shortNameSelectedMonth }}</span><i class="icon-chevron text-ns ml-3"></i>
              </div>
              <div class="cursor-pointer flex items-center tab" :class="{active: activeTab === 'years'}" @click="activeTab = 'years'">
                <span class="text-sm">{{ selectedDate.format('YYYY') }}</span><i class="icon-chevron text-ns ml-3"></i>
              </div>
            </div>
            <hr>
            <div v-show="activeTab === 'months'">
              <div class="months-years-selection flex flex-col">
                <span v-for="(month,i) in months" :key="i" class="month" :class="{active: isSelectedMonth(i)}" @click="selectMonthHandler(i)">
                  <i class="icon-check text-sm"></i>
                  {{ month }}
                </span>
              </div>
            </div>
            <div v-show="activeTab === 'years'">
              <div class="months-years-selection flex flex-col">
                <span v-for="(year,i) in years" :key="i" class="month" :class="{active: isSelectedYear(year)}" @click="selectYearHandler(year)">
                  <i class="icon-check text-sm"></i>
                  {{ year }}
                </span>
              </div>
            </div>
          </div>
        </div>
      <div class="popup-backdrop" :class="{showed: isMobileView() && showCalendar}"></div>
    </fieldset>
</template>

<script setup>
import { ref, computed, reactive, defineProps, onMounted, getCurrentInstance, defineEmits, watch } from 'vue';
import {isMobileDisplay} from "../scripts/custom";
import dayjs from "dayjs";

const emit = defineEmits(['dateSelected'])

const props = defineProps({
  startDate: {
    type: Object,
    default() {
      return new Date();
    },
  },
  name: {
    type: String,
    default: '',
  },
  className: {
    type: String,
    default: '',
  },
  id: {
    type: String,
    default: '',
  },
  placeholder: {
    type: String,
    default: '',
  },
  formatDate: {
    type: String,
    default: 'D MMM, YY'
  }
});

const defaultWidth = 360;
const weekdays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
const dates = reactive([]);

const instance = getCurrentInstance();
const uid = ref(instance.uid);
const $el = ref();
const now = ref(dayjs());
let selectedDate = ref(dayjs());
let result = ref();
let calendarWidth = ref('0');
let calendarLeft = ref('-2px');

const showMonths = ref(false);
const showCalendar = ref(false);
const activeTab = ref('months');
const years = reactive([]);
const nameSelectedMonth = computed(() => {
  return months[selectedDate.value.month()];
})
const shortNameSelectedMonth = computed(() => {
  return months[selectedDate.value.month()].substring(0,3);
})
const formattedResult = computed(() => {
  return result.value ? result.value.format(props.formatDate) : '';
})

const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

const maxFutureDate = computed(() => {
  return now.value.add(350, 'day');
});

function initYears() {
  const currentYear = now.value.year();
  const maxYear = maxFutureDate.value.year();
  for(let i = currentYear; i <= maxYear; i++){
    years.push(i);
  }
}

function nextMonth() {
  selectedDate.value = selectedDate.value.month(selectedDate.value.month()+1);
  initDays();
}

function previousMonth() {
  selectedDate.value = selectedDate.value.month(selectedDate.value.month()-1);
  initDays();
}

function initDays() {
  dates.splice(0, dates.length);
  const countDays = selectedDate.value.daysInMonth();

  const firstDayInWeek = selectedDate.value.clone().date(1).day();
  const allDaysInMonth = [];
  for(let i = 0; i < firstDayInWeek; i ++) {
    allDaysInMonth.push('');
  }
  for(let i = 0; i < countDays; i ++) {
    allDaysInMonth.push(i+1);
  }

  const countWeeks = Math.ceil(allDaysInMonth.length/7);
  for(let i = 0; i < countWeeks; i ++) {
    dates.push(allDaysInMonth.splice(0, 7));
  }
}

watch(() => props.startDate,  (newValue) => {
  if (selectedDate.value.isBefore(props.startDate, 'day')) {
    selectedDate.value = dayjs(newValue);
    result.value = selectedDate.value.clone();
  }
})

function selectDateHandler(value) {
  if (isDisabled(value)) {
    return;
  }
  selectedDate.value = selectedDate.value.date(value);
  result.value = selectedDate.value.clone().date(value);
  showCalendar.value = false;
  emit('dateSelected', new Date(selectedDate.value.format()))
}

function selectMonthHandler(value) {
  selectedDate.value = selectedDate.value.month(value);
  activeTab.value = 'years';
}

function selectYearHandler(value) {
  selectedDate.value = selectedDate.value.year(value);
  showMonths.value = false;
  activeTab.value = 'months';
}

function isToday(day) {
  return selectedDate.value.clone().date(day).isSame(now.value, 'day');
}

function isDisabled(day) {
  if (day === '') return true;
  const dateToCheck = selectedDate.value.clone().date(day);
  return dateToCheck.isBefore(props.startDate, 'day') || dateToCheck.isAfter(maxFutureDate.value, 'day');
}

function isSelected(day) {
  if (!result.value) {
    return false;
  }
  return selectedDate.value.clone().date(day).isSame(result.value);
}

function isSelectedMonth(month) {
  return selectedDate.value.month() === month;
}

function isSelectedYear(year) {
  return selectedDate.value.year() === year;
}

function init() {
  initYears();
  initDays();
}

function handleClick() {
  showCalendar.value = !showCalendar.value;
  const event = new CustomEvent('open-calendar', {detail: {uid: uid.value}});
  window.dispatchEvent(event);

  if (!isMobileView()) {
    return;
  }
  const el = document.querySelector('#' + props.id);
  window.scrollTo({top: $(el).offset().top - 100, behavior: "smooth"});
}

function isMobileView() {
  return isMobileDisplay();
}

function resetCalendarView() {
  showMonths.value = false;
  showCalendar.value = false;
  activeTab.value = 'months';
}

onMounted(() => {
  init();
  setTimeout(() => {
    if (!isMobileView()) {
      calendarWidth.value = defaultWidth + 'px';
      return;
    }
    const windowWidth = $(window).width();
    const el = $('#' + props.id);
    const rightOffset = (windowWidth - (el.offset().left));
    const newWidth = windowWidth - 48;
    if (rightOffset < newWidth) {
      calendarLeft.value = (rightOffset - newWidth - 24) + 'px';
    }
    calendarWidth.value = newWidth + 'px';
  })

  window.addEventListener('open-calendar', e => {
    if(uid.value !== e.detail.uid) {
      resetCalendarView();
    }
  });
});

</script>

<style scoped lang="scss">
  .calendar {
    position: absolute;
    background-color: #ffffff;
    z-index: 9999;
    top: -10px;
    box-shadow: 0 16px 56px rgba(0, 0, 0, 0.25);
    border-radius: 16px;
    opacity:0;
    visibility: hidden;
    transition: opacity 0.3s ease-out;
    &.opened {
      opacity: 1;
      visibility: visible;
    }
    /* width */
    ::-webkit-scrollbar {
      width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #F0F0F0;
      border-radius: 5px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #D7DBE0;
      border-radius: 5px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #D7DBE0;
    }
  }

  .calendar-month-year {
    @apply cursor-pointer hover:text-orange flex items-center;
    border-radius: 100px;
    padding: 10px 15px;
    &:active {
      background: rgba(221, 119, 0, 0.1);
    }
  }

  .icon-x {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    border: 1px solid #DBDCE0;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    cursor: pointer;
    &:hover {
      background-color: #F5D6B2;
      border: 1px solid #DD7700;
    }
    &:active {
      background-color: #F5D6B2;
      border: 1px solid #DD7700;
    }
  }

  .month-arrow {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    &:hover {
      background-color: #FCF1E5;
    }
    &:active {
      background-color: #F5D6B2;
    }
  }

  .months-years-header {
    padding: 10px 50px 10px;
    font-size: 14px;
    span {
      color: #cccccc;
    }
    i {
      display: none;
    }
    .active {
      span {
        color: #000000;
      }
      i {
        display: block;
      }
    }
    .tab {
      padding: 10px;
      border-radius: 20px;
      transition: 0.3s;
      &.active:hover {
        background-color: #ededee;
      }
    }
  }

  hr {
    border-color: #CAC4D0;
  }

  .months-years-selection {
    padding:10px 0;
    max-height: 360px;
    overflow: hidden;
    overflow-y: auto;
  }

  .month {
    padding: 13px 60px;
    cursor: pointer;
    color: #000000;
    font-size: 16px;
    transition: 0.3s;
    position: relative;
    .icon-check {
      position: absolute;
      color: #3D4043;
      left: 22px;
      top: 16px;
      display: none;
    }
    &.active {
      background-color: #ededee;
      .icon-check {
        display: block;
      }
    }
  }

  .calendar-days {
    font-size: 14px;
  }

  .days {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    justify-items: center;
    margin-bottom: 5px;
  }

  .day {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
    border-radius: 5px;
    width: 40px;
    height: 40px;
  }

  .dates {
    .day {
      font-family: GilroyMedium, sans,serif;
      cursor: pointer;
      &.disabled {
        opacity: 0.4;
        cursor: default;
      }
    }

    .day:not(.disabled, .selected):hover,  {
      background-color: #FCF1E5;
    }
    .day:not(.disabled, .selected):active {
      background-color: #F5D6B2;
    }
  }

  .selected {
    background-color: #DD7700;
    color: #ffffff;
  }

  .today {
    border: 1px solid #DD7700;
    color: #DD7700;
  }

  .weekdays {
    color: #787a7c;
  }
</style>