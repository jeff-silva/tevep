export default {
    state: {
        menu: [
            {label:"Dashboard", to:"/admin"},
            {label:"Páginas", children:[
                {label:"Buscar", to:"/admin/pages", children:[]},
                {label:"Novo", to:"/admin/pages/new", children:[]},
            ]},
            {label:"Usuários", children:[
                {label:"Buscar", to:"/admin/user", children:[]},
                {label:"Novo", to:"/admin/user/new", children:[]},
                {label:"Grupos", to:"/admin/users-groups", children:[]},
            ]},
            {label:"Configurações", to:"/admin/settings", children:[
                {label:"Configurações", to:"/admin/settings", children:[]},
                {label:"Templates de e-mails", to:"/admin/emails-templates", children:[]},
            ]},
            {label:"Uploads", children:[
                {label:"Buscar", to:"/admin/files", children:[]},
                {label:"Novo", to:"/admin/files/new", children:[]},
            ]},
            {label:"Tevep", to:"/admin/teveps"},
            {label:"Meus dados", to:"/admin/user/me"},
        ],
    },
}