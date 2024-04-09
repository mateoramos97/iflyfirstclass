import { createApp, ref } from "vue";
import {initFlightRequestForm} from "../../scripts/custom";
import {tomSelectInit} from "../../scripts/tom-select";
import Datepicker from "../Datepicker.vue";
import MultiFlights from "../MultiFlights.vue";

const form = createApp({
	setup() {
		const activeForm = ref(1);
		const peopleNumber = ref(1);
		const cabinClassName = ref(1);
		const showHiddenFields = ref(false);
		function changeActiveForm(event) {
			setActiveForm(event.target.value);
		}

		function setActiveForm(value) {
			activeForm.value = value;
			initFlightRequestForm();
			setTimeout(tomSelectInit, 100)

		}

		return {
			activeForm,
			showHiddenFields,
			changeActiveForm,
			setActiveForm,
			peopleNumber,
			cabinClassName,
		}
	},

	mounted() {
		const form = this.$el.parentElement.querySelector('form');

		$(form).find('input,select').change((e) => {
			this.showHiddenFields = true;
		})

		$(form).submit(function (e){
			const self = $(this);
			const hidden = self.find(".check-subscription");
			const from = self.find(".from").find('input[type=text]').first();
			const to = self.find(".to").find('input[type=text]').first();
			const button = self.find("button[type='submit']");

			hidden.val("jfghfHdhsdgUjbn345Hd");

			let error = false;

			self.find('.required-field').each(function () {
				$(this).removeClass("error-field");
			});

			self.find('.required-field').each(function () {
				const el = $(this);
				if (el.val() === '') {
					el.addClass("error-field");
					error = true;
				}
			});

			if (self.val().toLowerCase() === to.val().toLowerCase()) {
				from.addClass("error-field");
				to.addClass("error-field");
				error = true;
			}

			if (!error) {
				button.prop("disabled", true);
				button.html("Searching...");
				return true;
			}

			return false;
		});
		initFlightRequestForm();
	}
});

form.component('datepicker', Datepicker);
form.component('multi-flights', MultiFlights);
form.directive('click-outside', (el, binding) => {
	el.clickOutsideEvent = function(event) {
		// Check if the clicked element is neither the element
		// to which the directive is applied nor its child
		if (!(el === event.target || el.contains(event.target))) {
			// Invoke the provided method
			binding.value(event);
			// document.removeEventListener('click', el.clickOutsideEvent);
		}
	};
	document.addEventListener('click', el.clickOutsideEvent);
})
form.mount("#form-request")