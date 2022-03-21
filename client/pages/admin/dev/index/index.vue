<template>
    <div>
        <h3>Instalação</h3>
        <pre class="bg-dark p-2 m-0 text-white">composer install<br>npm install<br>php artisan app:install</pre>
        <br>
        
        <h3>Criar uma tabela</h3>
        <pre class="bg-dark p-2 m-0 text-white">php artisan app:table-generate</pre>
        <p>Após executar o comando, informe o nome da tabela para o banco.</p>
    </div>
</template>

<script>
export default {
    head() {
		return {
			title: "Principal",
		};
	},
}
</script>