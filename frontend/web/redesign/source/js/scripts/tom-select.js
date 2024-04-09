import TomSelect from "tom-select";

export const tomSelectInit = function () {
	document.querySelectorAll('.tom-select').forEach((el)=>{
		TomSelect.define('dropdown',function(){
			this.open = () => {
				// var self = this;
				if (this.isLocked || this.isOpen || (this.settings.mode === 'multi' && this.isFull())) return;
				this.isOpen = true;
				this.focus_node.setAttribute('aria-expanded',  'true');
				this.refreshState();
				this.dropdown.style.visibility = 'hidden';
				this.dropdown.style.display = 'block';
				this.positionDropdown();
				this.dropdown.style.visibility = 'visible';
				this.dropdown.style.display = 'block';
				this.focus();
				this.trigger('dropdown_open', this.dropdown);
			}

			this.close = () => {
				var trigger = this.isOpen;

				this.setTextboxValue();

				if (this.settings.mode === 'single' && this.items.length) {
					this.inputState();
				}


				this.isOpen = false;
				this.focus_node.setAttribute('aria-expanded',  'false');
				this.dropdown.style.visibility = 'hidden';
				if( this.settings.hideSelected ){
					this.clearActiveOption();
				}
				this.refreshState();

				if (trigger) this.trigger('dropdown_close', this.dropdown);
			}
		});
		let settings = {
			plugins:['dropdown'],
		};
		try {
			new TomSelect(el,settings);
		} catch {}
	});
}