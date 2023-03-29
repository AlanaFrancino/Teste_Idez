<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

<style>

.list-bullets {
    list-style: none;
}

.list-bullets li {
    display: flex;
    align-items: center;
}

.list-bullets li::before {
    content: '';
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #5784d7;
    border: 2px solid #8fb3f5;
    display: block;
    margin-right: 1rem;
}

body {
    min-height: 100vh;
    background-color: #6190e8;
    background-image: linear-gradient(to right, #5784d7 0%, #a7bfe8 100%);
}

li {
    font-style: italic;
}
</style>

<div class="container py-5">
    <!-- For demo purpose -->
    <header class="text-center text-white">
        <h1 class="display-4">Teste Idez</h1>
        <p class="lead mb-0 font-italic">Buscar cidade associadas ao estado</p>
        <p class="font-italic">Desenvolvido por
            <u>Alana Francino</u> 
        </p>

        <form method="get" action="{{ route('municipios.paginados') }}">
            <label for="uf">Estado:</label>
            <select name="uf" id="uf">
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
            <button type="submit">Buscar</button>
        </form>
    </header>

    <div class="row py-5">
        <div class="col-lg-7 mx-auto">

            <div class="card shadow mb-4">
                <div class="card-body p-5">
                    <h4 class="mb-4">Municípios</h4>

                    @isset($municipiosPaginados)
                        
                    <ul class="list-bullets">
                        @foreach ($municipiosPaginados as $municipio)
                            <li class="mb-2">{{ $municipio['nome'] }} ({{ $municipio['codigo_ibge'] }})</li>
                        @endforeach
                    </ul>

                    {{ $municipiosPaginados->links() }}

                    @endisset
                </div>
            </div>
        </div>
    </div>

</div>
