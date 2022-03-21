export default function (ctx) {
    ctx.$auth.settings = ctx.$auth.user.settings || {};
    delete ctx.$auth.user.settings;
}