<script lang="ts">
    interface Post {
        titulo: string;
        conteudo: string;
        id: number;
        capa: string;
        // coloca os campos que seu PHP retorna
    }
    let dados:Post[] = $state<Post[]>([])
    async function buscarPosts(){
        const res = await fetch('http://localhost:8000/export-json/main.php');
        dados = await res.json(); // vira array de objetos JS
    }
</script>
<h1>Oi</h1>
<button onclick={()=>buscarPosts()}>Sabor</button>
<main>
    {#each dados as dado}
    <div class="post">
        <img src="http://localhost:8000/blog/uploads/{dado.capa}" alt="">
        <div>
            <h1>{dado.titulo}</h1>
            <p>{dado.conteudo}</p>
        </div>
        
    </div>
    {/each}
</main>


<style>
h1{
    font-size: 20pt;
}
    button{
        background-color: red;
    }
    button:hover{
        cursor:pointer;
    }
    img{
        width: 200px;
        max-height: 500px;
    }
    main{
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .post{
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
    .post>div{
        display: flex;
        flex-direction: column;
    }
</style>