export default function (ctx) {
    console.log(ctx.$auth.user);
    ctx.$auth.settings = (ctx.$auth.user? ctx.$auth.user.settings: false) || {};
    if (ctx.$auth.user) { delete ctx.$auth.user.settings; }
}