export default class Tevep {

	user_id = "";
	title = "";
	divisor = "";
	nodes = [];
	date_start = "";
	date_final = "";
	_loading = false;

	constructor(attributes={}) {
		attributes = Object.assign({"user_id":"","title":"","divisor":"","nodes":[],"date_start":"","date_final":""}, attributes);
		for(var i in attributes) { this[i] = attributes[i]; }
	}

}