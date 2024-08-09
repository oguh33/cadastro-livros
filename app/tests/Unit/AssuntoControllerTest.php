<?php


use App\DTO\CreateAssuntoDTO;
use App\Http\Controllers\AssuntoController;
use App\Http\Requests\StoreAssuntoRequest;
use App\Models\Assunto;
use App\Services\AssuntoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AssuntoControllerTest extends TestCase
{

    public function test_create_store_successful()
    {
        // Mock da service AssuntoService
        $assuntoServiceMock = Mockery::mock(AssuntoService::class);
        $this->app->instance(AssuntoService::class, $assuntoServiceMock);

        // Mock da model Assunto
        $assuntoMock = Mockery::mock(Assunto::class);
        $assuntoMock->shouldReceive('create')->andReturn($assuntoMock);

        // Monta a request
        $requestData = [
            'descricao' => 'Novo assunto',
        ];

        // Cria a request StoreAssuntoRequest e valida
        $request = StoreAssuntoRequest::create('/assunto', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);
        $request->validateResolved();

        // Confirmando que o CreateAssuntoDTO foi criado com dados corretos
        $assuntoServiceMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CreateAssuntoDTO $dto) use ($requestData) {
                return $dto->descricao === $requestData['descricao'];
            }))
            ->andReturn($assuntoMock);

        // Cria instancia da controller Assunto
        $controller = new AssuntoController($assuntoServiceMock);

        // Chama o metodo store
        $response = $controller->store($request);

        //Verifica se foi de acordo com o esperado
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('assunto.index'), $response->getTargetUrl());
        $this->assertEquals('Assunto cadastrado com sucesso!', $response->getSession()->get('success'));
    }

    public function test_store_validation_fails()
    {
        // Preparar dados de solicitacao invalidos (nome curto)
        $requestData = [
            'descricao' => 'A',
        ];

        //Cria a request StoreAssuntoRequest
        $request = StoreAssuntoRequest::create('/assunto', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);

        // Validar as solicitacoes
        $validator = Validator::make($requestData, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('descricao', $validator->errors()->toArray());
    }
}
