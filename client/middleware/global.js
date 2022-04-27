export default function (ctx) {

    // Admin
    if (!ctx.route.path.match(/^\/admin/i)) return;
    let { store, route, app, $auth } = ctx;

    // Auth
    if (!$auth.loggedIn) {
        return app.router.push("/");
    }

    // Permissions
    if ($auth.user.id!=1 && $auth.user.group_id!=1) {
        let permissions = $auth.user.permissions || [];
        if (permissions.indexOf(route.name) == -1) {
            return app.router.push("/admin");
        }
    }

    // Layout
    let admin_layout_default = route.matched[0].components.default.options.layout;
    let admin_layout = store.state.settings['app.admin_layout'] || "admin";
    route.matched[0].components.default.options.layout = admin_layout_default || admin_layout;
}