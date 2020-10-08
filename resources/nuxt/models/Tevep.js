export default class Tevep {

	id = 0;
	user_id = "";
	title = "";
	divisor = "";
	nodes = [];
	date_start = "";
	date_final = "";
	_loading = false;

	constructor(attributes={}) {
		attributes = Object.assign({"id":0,"user_id":"","title":"","divisor":"","nodes":[],"date_start":"","date_final":""}, attributes);
		for(var i in attributes) { this[i] = attributes[i]; }
	}

}