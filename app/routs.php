<?php
/*
 * Blitz Framework - Small Framework to PHP
 * Copyright (C) 2016 Fernando Batels <luisfbatels@gmail.com>
 *
 * File to router
 *
 * Default router from https://github.com/bramus/router
 */

// Signup routes.
$this->router->get('/', function () {
	$this->callcontroller('contas', 'loginPage');
});

$this->router->get('/login', function () {
	$this->callcontroller('contas', 'loginPage');
});

// Login routes.
$this->router->post('/', function () {
	$this->callcontroller('contas', 'login');
});

$this->router->post('/login', function () {
	$this->callcontroller('contas', 'login');
});

$this->router->post('/', function () {
	$this->callcontroller('contas', 'login');
});

// Registration routes.
$this->router->get('/cadastro', function () {
	$this->callcontroller('contas', 'CadastroPage');
});

$this->router->post('/cadastro', function () {
	$this->callcontroller('contas', 'Cadastro');
});

// Session validation.
$this->router->before('GET|POST', '/u/.*', function () {
	$this->callcontroller('contas', 'loginValidate');
});

// Destroy the session.
$this->router->match('POST|GET', '/logoff', function () {
	$this->callcontroller('contas', 'logoff');
});

// Page seem after a successful login.
$this->router->match('POST|GET', '/u/home', function () {
	$this->callcontroller('index', 'index');
});

/**
 * People
 */

// Displays our souls.
$this->router->match('GET|POST', '/u/pessoa', function () {
	$this->callController('pessoas', 'index');
});

// Give birth to somenone.
$this->router->post('/u/pessoa/cadastro', function () {
	$this->callController('pessoas', 'write');
});

// Change someone (yes, easy like that).
$this->router->get('/u/pessoa/cadastro', function () {
	$this->callController('pessoas', 'new');
});

// Make someone bite the dust.
$this->router->get('/u/pessoa/remover', function () {
	$this->callController('pessoas', 'delete');
});

/**
 * Accounts
 */

// Displays our regustered accounts.
$this->router->match('GET|POST', '/u/usuarios', function () {
	$this->callController('usuarios', 'index');
});

// Register new account.
$this->router->post('/u/usuarios/cadastro', function () {
	$this->callController('usuarios', 'write');
});

// Change a account.
$this->router->get('/u/usuarios/cadastro', function () {
	$this->callController('usuarios', 'new');
});

// Disable a account.
$this->router->get('/u/usuarios/remover', function () {
	$this->callController('usuarios', 'delete');
});
