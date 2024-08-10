<?php

namespace Tests\Unit;

use App\DTO\CreateAuthorDTO;
use App\DTO\UpdateAuthorDTO;
use App\Http\Controllers\AuthorController;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;

# php artisan test --filter=AuthorControllerTest
class AuthorControllerTest extends TestCase
{

    protected $service;
    protected $controller;

    public function test_store_success()
    {
        // Mock da service AuthorService
        $autorServiceMock = Mockery::mock(AuthorService::class);
        $this->app->instance(AuthorService::class, $autorServiceMock);

        // Mock da model Author
        $autorMock = Mockery::mock(Author::class);
        $autorMock->shouldReceive('create')->andReturn($autorMock);

        // Monta a request
        $requestData = [
            'nome' => 'Nome do Author',
        ];

        // Cria a request StoreAuthorRequest e valida
        $request = StoreAuthorRequest::create('/author', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);
        $request->validateResolved();

        // Confirmando que o CreateAuthorDTO foi criado com dados corretos
        $autorServiceMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CreateAuthorDTO $dto) use ($requestData) {
                return $dto->nome === $requestData['nome'];
            }))
            ->andReturn($autorMock);

        // Cria instancia da controller Author
        $controller = new AuthorController($autorServiceMock);

        // Chama o metodo store
        $response = $controller->store($request);

        //Verifica se foi de acordo com o esperado
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('author.index'), $response->getTargetUrl());
        $this->assertEquals('Autor cadastrado com sucesso!', $response->getSession()->get('success'));
    }

    public function test_store_validation_fails()
    {
        // Preparar dados de solicitacao invalidos (nome curto)
        $requestData = [
            'nome' => 'Au',
        ];

        //Cria a request StoreAuthorRequest
        $request = StoreAuthorRequest::create('/author', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);

        // Validar as solicitacoes
        $validator = Validator::make($requestData, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_destroy_author()
    {

        $autorId = '1';

        $autorServiceMock = $this->createMock(AuthorService::class);
        $autorServiceMock->expects($this->once())
            ->method('delete')
            ->with($autorId);

        $controller = new AuthorController($autorServiceMock);


        $response = $controller->destroy($autorId);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('author.index'), $response->getTargetUrl());
        $this->assertEquals('Autor removido com sucesso!', session('success'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Cria um mock do AuthorService
        $this->service = Mockery::mock(AuthorService::class);

        // Cria uma instância do AuthorController usando o mock
        $this->controller = new AuthorController($this->service);
    }

    /*
    public function testUpdateSuccess()
    {

        $id = '1';
        $data = [
            'nome' => 'Nome Atualizado'
        ];

        // Cria um mock do UpdateAuthorRequest
        $request = Mockery::mock(UpdateAuthorRequest::class);
        $request->shouldReceive('validated')->andReturn($data);

        // Cria um DTO para o método update
        $updateDTO = UpdateAuthorDTO::makeFromRequest($request, $id);

        // Configura o mock para o método update retornar um valo
        $this->service->shouldReceive('update')
            ->with($updateDTO)
            ->andReturn(new \stdClass());

        // Chama o método update do controlador
        $response = $this->controller->update($request, $id);

        // Verifica o redirecionamento e a mensagem de sucesso
        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('success', 'Author editado com sucesso!');
    }
    */

}
