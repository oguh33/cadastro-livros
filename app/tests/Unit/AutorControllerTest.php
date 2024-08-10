<?php

namespace Tests\Unit;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Http\Controllers\AutorController;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;

# php artisan test --filter=AutorControllerTest
class AutorControllerTest extends TestCase
{

    protected $service;
    protected $controller;

    public function test_store_success()
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

    public function test_destroy_actor()
    {

        $autorId = '1';

        $autorServiceMock = $this->createMock(AutorService::class);
        $autorServiceMock->expects($this->once())
            ->method('delete')
            ->with($autorId);

        $controller = new AutorController($autorServiceMock);


        $response = $controller->destroy($autorId);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('autor.index'), $response->getTargetUrl());
        $this->assertEquals('Autor removido com sucesso!', session('success'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Cria um mock do AutorService
        $this->service = Mockery::mock(AutorService::class);

        // Cria uma instância do AutorController usando o mock
        $this->controller = new AutorController($this->service);
    }

    /*
    public function testUpdateSuccess()
    {

        $id = '1';
        $data = [
            'nome' => 'Nome Atualizado'
        ];

        // Cria um mock do UpdateAutorRequest
        $request = Mockery::mock(UpdateAutorRequest::class);
        $request->shouldReceive('validated')->andReturn($data);

        // Cria um DTO para o método update
        $updateDTO = UpdateAutorDTO::makeFromRequest($request, $id);

        // Configura o mock para o método update retornar um valo
        $this->service->shouldReceive('update')
            ->with($updateDTO)
            ->andReturn(new \stdClass());

        // Chama o método update do controlador
        $response = $this->controller->update($request, $id);

        // Verifica o redirecionamento e a mensagem de sucesso
        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('success', 'Autor editado com sucesso!');
    }
    */

}
