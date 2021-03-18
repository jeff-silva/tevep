<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    
    /**
     * Buscar Notificações de usuários
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\UserNotification)->search($request->all());
    }

    /**
     * Retornar Notificação de usuário por id
     */
    public function find($id) {
        return \App\Models\UserNotification::find($id);
    }

    /**
     * Salvar dados de Notificação de usuário
     */
    public function save(Request $request) {
        return (new \App\Models\UserNotification)->store($request->all());
    }

    /**
     * Deletar Notificação de usuário
     */
    public function delete($id) {
        return \App\Models\UserNotification::find($id)->remove();
    }
}