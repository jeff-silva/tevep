import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);


Vue.prototype.$log = function() {
	for(var i in arguments) {
		console.log(arguments[i]);
	}
};


Vue.prototype.$swalConfirm = function(html, call) {
	this.$swal({
		title: "Confirmação",
		html: html,
	}).then((resp) => {
		if (resp.value) {
			call();
		}
	});
};


Vue.prototype.$swalSuccess = function(title, html) {
	this.$swal({
		title: title||'',
		html: html||'',
		icon: 'success',
	});
};


Vue.prototype.$swalPrompt = function(question, callback) {
    this.$swal({
        // title: 'Submit your Github username',
        html: question,
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
    }).then((result) => {
        if (!result.isConfirmed) return;
        callback(result.value);
    });
};


Vue.prototype.$user = function(attr) {
	let user = JSON.parse(localStorage.getItem('user'));
	if (attr) return user[attr]||false;
    console.log(user);
	return user;
};


Vue.prototype.$geolocation = function() {
	if (!navigator.geolocation) return;
	return new Promise((resolve, reject) => {
		navigator.geolocation.getCurrentPosition((pos) => {
			resolve({
				lat: pos.coords.latitude,
				lng: pos.coords.longitude,
			})
		}, reject);
	});
};


Vue.filter('date', function(date) {
	let d = (date||'').split(/[^0-9a-zA-Z]/g);
	if (!d[1]) return '';
	return `${d[2]}/${d[1]}/${d[0]} ${d[3]}:${d[4]}`;
});


Vue.prototype.modelDefault = function(name=false) {
	let models = require('@/plugins/models.json');
	if (name) return models[name]||{};
	return models;
};