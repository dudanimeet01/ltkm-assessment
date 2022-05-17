
## About Algorithm
This is the code function in PHP that sums the numbers in a file and outputs details of the results. The function will receive as input the path to a single file. Each line of the file will contain either a number or a relative path to another file. For each file processed, output the file path and the sum of all of the numbers contained both directly in the file and in any of the sub files listed in the file (and their sub files, etc).


## Required Environment
#### Apache 2.4
#### PHP 7.3


## Project setup

Clone the repo

```bash
  git clone https://github.com/dudanimeet01/ltkm-assessment.git
```
Install the required dependencies using composer
```bash
  composer install
```
Copy the .env.example to .env file
```bash
  cp .env.example .env
```
Generate the application key for laravel
```bash
  php artisan key:generate
```
Run the project using 
```bash
  php artisan serve
```
Run test cases using
```bash
  php artisan test
```
## Documentation

Please refer the this [Google Doc](https://docs.google.com/document/d/1X0NX5zV3mRBxVa2H6lUOs-7CRbC4jb_SQ8yjqss8cLc) for documentation.


## Author

- [@dudanimeet01](https://github.com/dudanimeet01)

