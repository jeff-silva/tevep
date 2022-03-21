export default function (ctx) {
    let { $auth, route, app } = ctx;
    
    if ($auth.user.id==1 || $auth.user.group_id==1) return;
    let permissions = $auth.user.permissions || [];
    // console.log(route.name, permissions);
    
    if (permissions.indexOf(route.name) == -1) {
        console.log(ctx);
        // return app.router.push("/admin");
        return app.router.go(-1);
    }
}