import Vue from 'vue';

// https://github.com/Akryum/v-tooltip
import VTooltip from 'v-tooltip'
Vue.use(VTooltip);

// https://github.com/avil13/vue-sweetalert2
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

Vue.prototype.$swalError = function(title, html) {
	this.$swal({
		title: title||'',
		html: html||'',
		icon: 'error',
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


Vue.prototype.$user = function(attr=null) {
	let user = this.$auth.user||{};
	if (attr!==null) return user[attr]||false;
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



// Filters

import moment from 'moment';

Vue.filter('date', function(value, format='DD/MM/YYYY') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});

Vue.filter('time', function(value, format='hh:mm') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});

Vue.filter('datetime', function(value, format='DD/MM/YYYY à\\s hh:mm') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});


Vue.filter('timeago', function(date) {
	return 'time ago';
});

// Directives
