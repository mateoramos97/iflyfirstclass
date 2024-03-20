import { createApp, ref } from "vue";
import {initFlightRequestForm} from "../../scripts/custom";

createApp({
	setup() {
		const activeForm = ref(1);
		const showHiddenFields = ref(false);
		function changeActiveForm(event) {
			activeForm.value = event.target.value;
			initFlightRequestForm();
		}

		return {
			activeForm,
			showHiddenFields,
			changeActiveForm,
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
}).mount("#form-request");