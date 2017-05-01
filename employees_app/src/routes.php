<?php

// Routes
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Route groups
$app->group('/api', function () {
    $this->group('/employees', function () {
        $this->map(['GET'], '', 'EmployeeController:index');
        $this->map(['GET'], '/{id}', 'EmployeeController:detailById');
    });

    $this->group('/search', function () {
        $this->map(['POST'], '/employee', 'EmployeeController:searchByEmail');
        $this->map(['GET'], '/employees/salary', 'EmployeeController:searchBySalary');
    });
});
