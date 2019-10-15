		let btnOrder,btnManage,btnCancel,btnGas,btnDamage;
		let orderBox,cancelBox,manageBox,gasBox,damageBox;
		
	
		window.addEventListener('load', e => {
			btnGas = document.querySelector('#btnGas');
			btnDamage = document.querySelector('#btnDamage');
			btnOrder = document.querySelector('#btnOrder');
			btnCancel = document.querySelector('#btnCancel');
			btnManage = document.querySelector('#btnManage');
			gasBox = document.querySelector('#gasBox');
			damageBox = document.querySelector('#damageBox');
			orderBox = document.querySelector('#orderBox');
			cancelBox = document.querySelector('#cancelBox');
			manageBox = document.querySelector('#manageBox');

			loadFromLocalStorage();
			window.onload = hideWebhostImp();
			
			btnCancel.addEventListener('click', e=> {
				goToCancelScreen();
				
			});
			
			btnGas.addEventListener('click', e=> {
				goToGasScreen();
				
			});
			btnDamage.addEventListener('click', e=> {
				goToDamageScreen();
				
			});

			btnOrder.addEventListener('click', function(e) {
				goToOrderScreen();
				
			});

			btnManage.addEventListener('click', e => {
				goToManageScreen();
				
			});
			upload.addEventListener('click', e => {
				showLoading();
			});
		});
		
	
		function goToGasScreen() {
			orderBox.style.display = 'none';
			cancelBox.style.display = 'none';
			manageBox.style.display = 'none';
			damageBox.style.display = 'none';
			gasBox.style.display = 'block';
			
		}
		function goToDamageScreen() {
			orderBox.style.display = 'none';
			cancelBox.style.display = 'none';
			manageBox.style.display = 'none';
			gasBox.style.display = 'none';
			damageBox.style.display = 'block';
			
		}
		
		function goToCancelScreen() {
			damageBox.style.display = 'none';
			orderBox.style.display = 'none';
			cancelBox.style.display = 'block';
			manageBox.style.display = 'none';
			gasBox.style.display = 'none';
			
		}

		function goToOrderScreen() {
			damageBox.style.display = 'none';
			orderBox.style.display = 'block';
			cancelBox.style.display = 'none';
			manageBox.style.display = 'none';
			gasBox.style.display = 'none';
			
		}

		function goToManageScreen() {
			damageBox.style.display = 'none';
			orderBox.style.display = 'none';
			cancelBox.style.display = 'none';
			manageBox.style.display = 'block';
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
		
		function showLoading(){
		document.getElementById("loading").style = "visibility: visible";
		}
		function hideLoading(){
		document.getElementById("loading").style = "visibility: hidden";
		}
		
