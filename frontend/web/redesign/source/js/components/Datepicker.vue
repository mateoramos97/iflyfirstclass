<template>
    <fieldset class="relative" :data-uid="uid" v-click-outside="resetCalendarView">
        <input :name="name" :id="id" :placeholder="placeholder" :class="className"  :value="formattedResult"
               readonly
               @click.stop="handleClick"
               autocomplete="off">
        <div class="calendar shadow-lg"  v-show="showCalendar" :style="{left:leftPositionCalendar}">
          <div class="dates-wrapper" v-show="!showMonths">
            <div class="flex justify-between items-center">
              <div class="cursor-pointer" @click="showMonths = true">
                <span class="text-sm">{{ nameSelectedMonth }} {{ selectedDate.format('YYYY') }}</span><i class="icon-chevron text-ns ml-3"></i>
              </div>
              <div class="">
                <i class="icon-arrow-left text-xs cursor-pointer" @click="previousMonth()"></i>
                <i class="icon-arrow-right text-xs ml-5 cursor-pointer" @click="nextMonth()"></i>
              </div>
            </div>
            <div class="calendar-days">
              <div class="days weekdays">
                <span v-for="(day,index) in weekdays" :key="index" class="day">{{ day }}</span>
              </div>
              <div class="dates">
                <div v-for="(weeks,i) in dates" :key="i" class="days">
                  <span v-for="(day,j) in weeks" :key="j"
                        class="day"
                        :class="{today: isToday(day), disabled: day === '', selected: isSelected(day)}"
                        @click="selectDateHandler(day)"
                  >{{ day }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="months-years-wrapper" v-show="showMonths">
            <div class="months-years-header flex justify-between items-center">
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
                <span v-for="(month,i) in months" :key="i" class="month" @click="selectMonthHandler(i)">
                  <i class="icon-check text-sm" v-if="isSelectedMonth(i)"></i>
                  {{ month }}
                </span>
              </div>
            </div>
            <div v-show="activeTab === 'years'">
              <div class="months-years-selection flex flex-col">
                <span v-for="(year,i) in years" :key="i" class="month" @click="selectYearHandler(year)">
                  <i class="icon-check text-sm" v-if="isSelectedYear(year)"></i>
                  {{ year }}
                </span>
              </div>
            </div>
          </div>
        </div>
    </fieldset>
</template>

<script setup>
import { ref, computed, reactive, defineProps, onMounted, getCurrentInstance } from 'vue';
import dayjs from "dayjs";

const props = defineProps({
  startDate: {
    type: String,
    default: '',
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

const weekdays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
const dates = reactive([]);

const instance = getCurrentInstance();
const uid = ref(instance.uid);
const $el = ref();
const now = ref(dayjs());
let selectedDate = ref(dayjs());
let result = ref();
let leftPositionCalendar = ref(0);

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

const months = ['January', 'February', 'Mart', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

function initYears() {
  const currentYear = now.value.year();
  for(let i = currentYear; i < (currentYear + 7); i++){
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
  const countDays = now.value.daysInMonth();

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

function selectDateHandler(value) {
  selectedDate.value = selectedDate.value.date(value);
  result.value = selectedDate.value.clone().date(value);
  showCalendar.value = false;
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
  return selectedDate.value.clone().date(day).isSame(now.value);
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
  const el = $('#' + props.id);
  const rightOffset = ($(window).width() - (el.offset().left));
  if (rightOffset < 300) {
    leftPositionCalendar.value = (rightOffset - 300) + 'px';
  }
  showCalendar.value = !showCalendar.value;
  const event = new CustomEvent('open-calendar', {detail: {uid: uid.value}});
  window.dispatchEvent(event);
}

function resetCalendarView() {
  showMonths.value = false;
  showCalendar.value = false;
  activeTab.value = 'months';
}

onMounted(() => {
  init();
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
    top: 100%;
    width: 300px;
    background-color: #ffffff;
    z-index: 9999;
    margin-top: -10px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
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

  .dates-wrapper {
    padding:20px;
  }

  .months-years-header {
    padding: 15px 45px;
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
  }

  .months-years-selection {
    padding:10px 0;
    max-height: 310px;
    overflow: hidden;
    overflow-y: auto;
  }

  .month {
    padding: 10px 45px;
    cursor: pointer;
    color: #000000;
    font-size: 16px;
    transition: 0.3s;
    position: relative;
    .icon-check {
      position: absolute;
      color: #3D4043;
      left: 10px;
      top: 12px;
    }
  }

  .month:hover {
    background-color: #ededee;
  }

  .calendar-days {
    margin-top: 20px;
    font-size: 14px;
  }

  .days {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    margin-bottom: 7px;
  }

  .day {
    padding: 6px 9px;
    text-align: center;
    transition: 0.3s;
    border-radius: 5px;
    cursor: pointer;
  }

  .dates .day:not(.disabled):hover {
    background-color: #DD7700;
    color: #ffffff;
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