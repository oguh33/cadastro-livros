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
        // Mock service AuthorService
        $autorServiceMock = Mockery::mock(AuthorService::class);
        $this->app->instance(AuthorService::class, $autorServiceMock);

        // Mock model Author
        $autorMock = Mockery::mock(Author::class);
        $autorMock->shouldReceive('create')->andReturn($autorMock);

        // Mount request
        $requestData = [
            'nome' => 'Nome do Author',
        ];

        // Create request StoreAuthorRequest and validate
        $request = StoreAuthorRequest::create('/author', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);
        $request->validateResolved();

        // Confim CreateAuthorDTO was created whith the correct data
        $autorServiceMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CreateAuthorDTO $dto) use ($requestData) {
                return $dto->nome === $requestData['nome'];
            }))
            ->andReturn($autorMock);

        // Create instance of the AuthorController
        $controller = new AuthorController($autorServiceMock);

        // Call the method store
        $response = $controller->store($request);

        //Verify if check if it is as expected
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('author.index'), $response->getTargetUrl());
        $this->assertEquals('Autor cadastrado com sucesso!', $response->getSession()->get('success'));
    }

    public function test_store_validation_fails()
    {
        // Prepare data request invalid (name short)
        $requestData = [
            'nome' => 'Au',
        ];

        //Create request StoreAuthorRequest
        $request = StoreAuthorRequest::create('/author', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);

        // valid request
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

}
