export default {
    state: {
        menu: [
            {label:"Dashboard", to:"/admin"},
            {label:"Páginas", children:[
                {label:"Buscar", to:"/admin/pages", children:[]},
                {label:"Novo", to:"/admin/pages/new", children:[]},
            ]},
            {label:"Usuários", children:[
                {label:"Buscar", to:"/admin/users", children:[]},
                {label:"Novo", to:"/admin/users/new", children:[]},
                {label:"Grupos", to:"/admin/users-groups", children:[]},
            ]},
            {label:"Configurações", to:"/admin/settings", children:[
                {label:"Configurações", to:"/admin/settings", children:[]},
                {label:"Templates de e-mails", to:"/admin/emails-templates", children:[]},
                {label:"Uploads", to:"/admin/files", children:[]},
                {label:"Endereços", to:"/admin/places", children:[]},
            ]},
            {label:"Tevep", to:"/admin/teveps"},
            {label:"Meus dados", to:"/admin/users/me"},
        ],
    },
}