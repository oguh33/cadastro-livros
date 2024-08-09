<?php

namespace Tests\Unit;

use App\DTO\CreateAutorDTO;
use App\Http\Controllers\AutorController;
use App\Http\Requests\StoreAutorRequest;
use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{

    public function test_store_successful()
    {
        // Mock da service AutorService
        $autorServiceMock = Mockery::mock(AutorService::class);
        $this->app->instance(AutorService::class, $autorServiceMock);

        // Mock da model Autor
        $autorMock = Mockery::mock(Autor::class);
        $autorMock->shouldReceive('create')->andReturn($autorMock);

        // Monta a request
        $requestData = [
            'nome' => 'Nome do Autor',
        ];

        // Cria a request StoreAutorRequest e valida
        $request = StoreAutorRequest::create('/autor', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);
        $request->validateResolved();

        // Confirmando que o CreateAutorDTO foi criado com dados corretos
        $autorServiceMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CreateAutorDTO $dto) use ($requestData) {
                return $dto->nome === $requestData['nome'];
            }))
            ->andReturn($autorMock);

        // Cria instancia da controller Autor
        $controller = new AutorController($autorServiceMock);

        // Chama o metodo store
        $response = $controller->store($request);

        //Verifica se foi de acordo com o esperado
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('autor.index'), $response->getTargetUrl());
        $this->assertEquals('Autor cadastrado com sucesso!', $response->getSession()->get('success'));
    }

    public function test_store_validation_fails()
    {
        // Preparar dados de solicitacao invalidos (nome curto)
        $requestData = [
            'nome' => 'Au',
        ];

        //Cria a request StoreAutorRequest
        $request = StoreAutorRequest::create('/autor', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);

        // Validar as solicitacoes
        $validator = Validator::make($requestData, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }
}
