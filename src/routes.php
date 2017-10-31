<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Routes

$app->get('/organisations/add', 'OrganisationController:add')->setName('organisation.add');
$app->post('/organisation/add', 'OrganisationController:insert')->setName('organisation.insert');

$app->post('/organisations/amend', 'OrganisationController:amend')->setName('organisation.update');

$app->get('/organisation/delete/{id}', 'OrganisationController:delete')->setName('organisations.delete');
$app->get('/organisation/amend/{id}', 'OrganisationController:amend')->setName('organisations.amend');
$app->get('/organisation', 'OrganisationController:getOrganisation')->setName('organisation');
$app->get('/organisations', 'OrganisationController:getAll')->setName('organisations');

$app->get('/user/{id}', 'UserController:updUser')->setName('user.amend');
$app->get('/user/delete/{id}', 'UserController:delUser')->setName('user.delete');
$app->get('/users', 'UserController:getAll')->setName('users');
$app->get('/users/add', 'UserController:add')->setName('user.add');
$app->post('/user/add', 'UserController:insert')->setName('user.insert');

$app->get('/', 'IndexController:index')->setName('login');
$app->post('/', 'IndexController:login')->setName('login.user');

$app->get('/welcome', 'WelcomeController:index')->setName('welcome');

$app->get('/logout', 'IndexController:logout')->setName('logout');