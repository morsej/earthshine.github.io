// get the inputs
      const inputs = [].slice.call(document.querySelectorAll('.controls input'));

      // listen for changes
      inputs.forEach(input => input.addEventListener('change', handleUpdate));
      inputs.forEach(input => input.addEventListener('mousemove', handleUpdate));

      function handleUpdate(e) {
		var moon = document.getElementById('moon');
        // append 'px' to the end of spacing and blur variables
		var amount = this.value;
		if(amount > 50 && this.id != 'base'){
			amount = amount - ((amount - 50) * 2)
			
			moon.setAttribute('style', 'transform: scale(-2);');
		}else if(this.id != 'base'){
			moon.setAttribute('style', 'transform: scale(2);');
		}
		  
		const negValue = (this.id === 'base' ? amount : amount * -1);
        const suffix = (this.id === 'base' ? '' : 's');
        document.documentElement.style.setProperty(`--${this.id}`, negValue + suffix);
      }