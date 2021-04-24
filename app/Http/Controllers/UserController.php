<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="User",
 *     description="Endpoints de usuário",
 * )
 */

class UserController extends Controller
{
    
    /**
     * Buscar Usuários
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */

    /**
     * @OA\Get(
     *      path="/user/search",
     *      operationId="user-search",
     *      tags={"User"},
     *      summary="Buscar usuários",
     *      description="Buscar usuários",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    public function search(Request $request) {
        return (new \App\Models\User)->search($request->all());
    }

    
    /**
     * @OA\Get(
     *      path="/user/find/{id}",
     *      operationId="user-find",
     *      tags={"User"},
     *      summary="Encontrar usuário por ID",
     *      description="Encontrar usuário por ID",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    public function find($id) {
        return \App\Models\User::find($id);
    }


    /**
     * @OA\Post(
     *      path="/user/save",
     *      operationId="user-save",
     *      tags={"User"},
     *      summary="Salvar dados de usuários",
     *      description="Salvar dados de usuários",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    public function save(Request $request) {
        return (new \App\Models\User)->store($request->all());
    }

    
    /**
     * @OA\Post(
     *      path="/user/delete/{id}",
     *      operationId="user-delete",
     *      tags={"User"},
     *      summary="Deletar usuário",
     *      description="Deletar usuário",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    public function delete($id) {
        return \App\Models\User::find($id)->remove();
    }
}