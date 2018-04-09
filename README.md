## Boarding pass sorter
[![Build Status](https://travis-ci.org/emirb-test/journey.svg?branch=master)](https://travis-ci.org/emirb-test/journey)

This is a simple boarding pass sorter algorithm made for solving travelling salesman problem.

## Installation
```
composer install
vendor/bin/phpunit
```

## Extending the Journey with new transportation methods
Adding new transportation method (i.e. ferry) would require you to extend AbstractBoardingPass and implement BoardingPassInterface. In case that boarding pass has more specific data, it can have more arguments in it's own constructor. Otherwise, the one from the abstract will do just fine as it only requires departure and arrival locations.

## Expectations
[x] 1. Well-structured code:
- all boarding passes are defined as data models. They know how to format themselves using internal `__toString.`
- sorter is encapsulated in its own class and dependent only on models
- integration is made within Journey class which accepts multiple BoardingPassInterface instances and prepares the output
- Note: further split could be made by introducing a special descriptor classes (like Symfony descriptors), in case we would like to have JSON, HTML, table or other ways to format the boarding passes.

[x] 2. Understanding of OOP
- as mentioned above, classes are standalone and isolated. I tried to approach the development using TDD and SOLID principle in mind.

[x] 3. Understanding of TDD
- development used TDD approach
- 100% code coverage reached
- sorter algorithm is tested fully and also covers couple of edge cases
- journey class test acts as an integration test. I didn't want to have an index.php - you should rather just clone the repository, install composer dependencies and run unit tests to check completion of task.
- models are not fully tested as that was outside of the scope of the test.

[x] 4. Delivering simple solution to a given problem
- overall count of code lines is below 500
- cyclomatic complexity is low
- CRAP level is low and acceptable, due to unit tests
- all code is readable and comprehensible, and doesn't require much comments at all.

[x] 5. Working with limited time to solve problem of significant complexity:
- took 2:40, some time spent on setting up the project in PhpStorm and writing README, 60% spent on unit tests and more time spent on formatting than on the actual algorithm :)

[x] 6. Efficiency of sorting algorithm
- sorter works in a way that it creates two hash maps; to be precise: indexed arrays of arrivals and departures with their cities as keys, finds first boarding pass and then iterates through the set. Overall complexity is 3 O(N)
