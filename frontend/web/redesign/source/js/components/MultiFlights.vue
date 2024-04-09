<template>
  <div>
    <div class="destination-block-wrapper flex flex-col gap-4">
      <div class="destination-row flex align-center relative grid xl:grid-cols-10 gap-3" :data-destination-id="number" v-for="(number,index) in flights">
        <div class="field-row from grow relative col-span-3 autocomplete-wrapper">
          <i class="input-prefix icon-airplan-fly text-gray bottom-4"></i>
          <input name="FlightRequestMax[from][]"
                 :id="'flightrequestmax_from_multi_city_' + number"
                 placeholder="Where from ?"
                 class="has-prefix has-suffix from field-from required-field autocomplete-value-input bg-white"
          >
          <i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
          <div class="autocomplete-enter-input-wrapper">
            <i class="input-prefix icon-airplan-fly text-orange bottom-4"></i>
            <input class="has-prefix autocomplete" placeholder="Where from ?">
          </div>
        </div>
        <div class="field-row to grow relative col-span-3 autocomplete-wrapper">
          <i class="input-prefix icon-airplan-land text-gray bottom-4"></i>
          <input name="FlightRequestMax[to][]"
                 :id="'flightrequestmax_to_multi_city_' + number"
                 placeholder="Where to ?"
                 class="has-prefix has-suffix from field-from required-field autocomplete-value-input bg-white"
          >
          <i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
          <div class="autocomplete-enter-input-wrapper">
            <i class="input-prefix icon-airplan-land text-orange bottom-4"></i>
            <input class="has-prefix autocomplete" placeholder="Where to ?">
          </div>
        </div>
        <div class="form-group field-row field-data flex grow flex-col col-span-3">
          <i class="input-prefix icon-calendar text-gray top-[14px] text-lg"></i>
          <datepicker
              name="FlightRequestMax[dep_date][]"
              placeholder="Departure"
              :id="'dep-date-multi-city-' + number"
              class-name="has-prefix has-suffix required-field w-full bg-white"
          ></datepicker>
          <i class="input-suffix icon-chevron text-ns absolute text-gray bottom-6"></i>
        </div>
        <div class="flex items-center justify-center xl:col-span-1 col-span-3" @click="removeFlight(index)">
          <div class="remove-flight bg-white rounded-full p-4"></div>
        </div>
      </div>
    </div>
    <div class="flex items-center mt-2 justify-center" v-if="flights.length < 3">
      <div class="add-destination bg-white rounded-full p-4">
        <a href="javascript:void(0)" @click="addFlight">Add flight</a>
      </div>
    </div>
  </div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import {InitAutocompleteAirport} from "../scripts/autocomplete";

const flights = ref([1]);

function addFlight() {
  flights.value.push(flights.value.length + 1);
  setTimeout(InitAutocompleteAirport);
}

function removeFlight(index) {
  flights.value.splice(index, 1);
}

onMounted(() => {
  setTimeout(InitAutocompleteAirport, 100);
});

</script>

<style scoped lang="scss">

</style>