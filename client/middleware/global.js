export default function (ctx) {
    let { store, route, app, $auth } = ctx;
    let settings = store.state.settings;
    let component = route.matched[0].components.default;

    // Favicon
    if (settings['app.icon']) {
        Array.from(document.querySelectorAll('head meta, head link')).forEach(elem => {
            if (! ['shortcut-icon', 'apple-touch-icon'].includes(elem.dataset.hid)) return;
            elem.href = settings['app.icon'];
        });
    }


    // Admin verifications
    if (!ctx.route.path.match(/^\/admin/i)) return;

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
    let admin_layout_default = component.options.layout;
    let admin_layout = settings['app.admin_layout'] || "admin";
    component.options.layout = admin_layout_default || admin_layout;
}