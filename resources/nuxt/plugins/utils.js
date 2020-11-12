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



Vue.prototype.$adminMenu = function() {
	return [
		{to:"/dashboard", title:"Dashboard", icon:"fas fa-home", children:[]},
		{to:"", title:"Tevep", icon:"fas fa-shopping-bag", children:[
			{to:"/tevep", title:"Projetos", icon:"fas fa-shopping-bag", children:[]},
			{to:"/tevep/0", title:"Novo", icon:"fas fa-shopping-bag", children:[]},
		]},
		{to:"/user/", title:"Usuários", icon:"fas fa-user", children:[]},
		{to:"", title:"Configurações", icon:"fas fa-cog", children:[
			// {to:"/dashboard/settings/", title:"Dados", icon:"fas fa-cog", children:[]},
			{to:"/dashboard/settings-user", title:"Meus dados", icon:"fas fa-cog", children:[]},
		]},
	];
};


// Filters

import moment from 'moment';

Vue.filter('date', function(value, format='DD/MM/YYYY') {
	let d = moment(value);
	return d.isValid()? d.format(format): '';
});


Vue.filter('timeago', function(date) {
	return 'time ago';
});

// Directives
