<?php


use App\DTO\CreateSubjectDTO;
use App\Http\Controllers\SubjectController;
use App\Http\Requests\StoreSubjectRequest;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

# php artisan test --filter=SubjectControllerTest
class SubjectControllerTest extends TestCase
{

    public function test_create_store_success()
    {
        $assuntoServiceMock = Mockery::mock(SubjectService::class);
        $this->app->instance(SubjectService::class, $assuntoServiceMock);

        $assuntoMock = Mockery::mock(Subject::class);
        $assuntoMock->shouldReceive('create')->andReturn($assuntoMock);

        $requestData = [
            'descricao' => 'Novo assunto',
        ];


        $request = StoreSubjectRequest::create('/subject', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);
        $request->validateResolved();


        $assuntoServiceMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (CreateSubjectDTO $dto) use ($requestData) {
                return $dto->descricao === $requestData['descricao'];
            }))
            ->andReturn($assuntoMock);


        $controller = new SubjectController($assuntoServiceMock);


        $response = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('subject.index'), $response->getTargetUrl());
        $this->assertEquals('Assunto cadastrado com sucesso!', $response->getSession()->get('success'));
    }

    public function test_store_validation_fails()
    {

        $requestData = [
            'descricao' => 'A',
        ];

        $request = StoreSubjectRequest::create('/subject', 'POST', $requestData);
        $request->setContainer($this->app)->setRedirector($this->app['redirect']);


        $validator = Validator::make($requestData, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('descricao', $validator->errors()->toArray());
    }

    public function test_destroy_subject()
    {

        $subjectId = '1';

        $subjectServiceMock = $this->createMock(SubjectService::class);
        $subjectServiceMock->expects($this->once())
            ->method('delete')
            ->with($subjectId);

        $controller = new SubjectController($subjectServiceMock);


        $response = $controller->destroy($subjectId);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('subject.index'), $response->getTargetUrl());
        $this->assertEquals('Assunto removido com sucesso!', session('success'));
    }
}
