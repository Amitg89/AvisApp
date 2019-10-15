			let btnFood,btnGas, btnDamage;
			let foodBox,gasBox, damageBox;
            
			window.addEventListener('load', e => {
				btnGas = document.querySelector('#btnGas');
				btnFood = document.querySelector('#btnFood');
				btnDamage = document.querySelector('#btnDamage');
				gasBox = document.querySelector('#gasBox');
				foodBox = document.querySelector('#foodBox');
				damageBox = document.querySelector('#damageBox');

				loadFromLocalStorage();
				window.onload = hideWebhostImp();
				
				
				btnGas.addEventListener('click', e=> {
					
					
					goToGasScreen();
					
				});

				btnFood.addEventListener('click', function(e) {
					goToFoodScreen();	
				});
				btnDamage.addEventListener('click', function(e) {
					goToDamageScreen();	
				});

			});
			
			function goToGasScreen() {
				
				
				foodBox.style.display = 'none';
				gasBox.style.display = 'block';
				damageBox.style.display = 'none';
				
				
			}

			function goToFoodScreen() {
				
				foodBox.style.display = 'block';
				gasBox.style.display = 'none';
				damageBox.style.display = 'none';
				
			}
			function goToDamageScreen() {
				
				damageBox.style.display = 'block';
				foodBox.style.display = 'none';
				gasBox.style.display = 'none';
				
			}


			function saveToLocalStorage() {
				let val = document.querySelector("#inputEmpNum").value;
				localStorage.setItem('emp',val);
			}

			function loadFromLocalStorage() {
				let val = localStorage.getItem('emp');
				if (!val){
					val = '';
				}
				document.querySelector("#inputEmpNum").value = val;
			}
			function hideWebhostImp(){
				let allDivs = document.querySelectorAll('div');                
				let len = allDivs.length;
				let divToHide = allDivs[len - 1];
				if (parseInt(divToHide.style.zIndex) > 1000)
				{
				divToHide.style.display = 'none';
				}
			}