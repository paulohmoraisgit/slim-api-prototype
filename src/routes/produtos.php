<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Rotas para produtos
$app->group('/api/v1', function () {
	$this->get('/produtos/listar', function ($request, $response) {
		$produtos = Produto::get();
		return $response->withJson($produtos);
	});

	$this->post('/produtos/adicionar', function ($request, $response) {
		$dados = $request->getParsedBody();
		$produto = Produto::create($dados);

		return $response->withJson($produto);
	});

	$this->get('/produtos/listar/{id}', function ($request, $response, $args) {
		$produto = Produto::findOrFail($args['id']);

		return $response->withJson($produto);
	});

	$this->put('/produtos/atualizar/{id}', function ($request, $response, $args) {
		$dados = $request->getParsedBody();

		$produto = Produto::findOrFail($args['id']);
		$produto->update($dados);

		return $response->withJson($produto);
	});

	$this->get('/produtos/remover/{id}', function ($request, $response, $args) {
		$produto = Produto::findOrFail($args['id']);
		$produto->delete();

		return $response->withJson($produto);
	});
});