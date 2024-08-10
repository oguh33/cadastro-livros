@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">DESAFIO</h1>

<div class="container mt-4">
    <h4> Objetivo: </h4>
    <p class="text-justify">Criar um projeto utilizando as boas práticas de mercado e apresentar o mesmo demonstrando o passo a passo de sua criação (base de dados, tecnologias, aplicação, metodologias, frameworks, etc).</p>

    <h4> Projeto: </h4>
    <p class="text-justify">O projeto consiste em um cadastro de livros. No final deste documento foi disponibilizado um modelo dos dados.</p>

    <h4> Tecnologia: </h4>
    <p class="text-justify">A tecnologia a ser utilizada é sempre Web e referente à vaga em que está concorrendo. A implementação do projeto ficará por sua total responsabilidade, assim como os componentes a serem utilizados (relatórios, camada de persistência, etc) com algumas premissas. O banco de dados é o de sua preferência. A utilização de camada de persistência também é escolha sua.</p>

    <h4> Instruções: </h4>
    <p class="text-justify">Deve ser feito CRUD para Livro, Autor e Assunto conforme o modelo de dados. A tela inicial pode ter um menu simples ou mesmo links direto para as telas construídas. O modelo do banco deve ser seguido integralmente, salvo para ajustes de melhoria de performance.</p>
    <p class="text-justify">A interface pode ser simples, mas precisa utilizar algum CSS que comande no mínimo a cor e tamanho dos componentes em tela (utilização do Bootstrap será um diferencial). Os campos que pedem formatação devem possuir o mesmo (data, moeda, etc).</p>
    <p class="text-justify">Deve ser feito obrigatoriamente um relatório (utilizando o componente de relatórios de sua preferência (Crystal, ReportViewer, etc)) e a consulta desse relatório deve ser proveniente de uma view criada no banco de dados. Este relatório pode ser simples, mas permita o entendimento dos dados. O relatório deve trazer as informações das 3 tabelas principais agrupando os dados por autor (atenção pois um livro pode ter mais de um autor).</p>
    <p class="text-justify">TDD (Test Driven Development) será considerado um diferencial. Tratamento de erros é essencial, evite try catchs genéricos em situações que permitam utilização de tratamentos específicos, como os possíveis erros de banco de dados. As mensagens emitidas pelo sistema, labels e etc ficam a seu critério. O modelo inicial não prevê, mas é necessário incluir um campo de valor (R$) para o livro.</p>
    <p class="text-justify">Guarde todos os scripts e instruções para implantação de seu projeto, eles devem ser demonstrados na apresentação.</p>

    <h4> Apresentação: </h4>
    <p class="text-justify">O teste deve ser apresentado na entrevista técnica que será agendada. A ideia é discutir seu projeto, avaliar o mesmo funcionalmente e tecnicamente.</p>

    <h5> Modelo: </h5>
    <p class="text-center">
        <img src="{{ asset('img/modelo.png') }}" alt="Modelo DB">
    </p>
</div>

@endsection
