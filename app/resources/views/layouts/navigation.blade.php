<header>
    <nav class="navbar navbar-expand-lg navStyle">
        <img src="{{ asset('img/logo.png') }}" alt="Logo PHP"
        style="display: block; margin: 0 auto; width: 50px;">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainMenu">
            <span><i class="fas fa-align-right iconStyle"></i></span>
        </button>

        <div class="collapse navbar-collapse  align-items-center" id="mainMenu">
            <ul class="navbar-nav ml-auto navList">
                <li class="nav-item">
                    <a href="/" class="nav-link"><i class="fas fa-book"></i> Livros</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subject.index') }}" class="nav-link"><i class="fas fa-cogs"></i> Assuntos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('autor.index') }}" class="nav-link"><i class="fas fa-address-card"></i> Autores</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('relatorio.index') }}" class="nav-link"><i class="fas fa-list"></i> Relatórios</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
