export default function ({ store, redirect }) {
	if (!localStorage.getItem('access_token')) {
		localStorage.setItem('access_token', '');
		localStorage.setItem('user', '');
		return redirect('/auth', {redirect:location.href});
	}
}