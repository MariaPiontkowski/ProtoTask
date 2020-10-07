## Sobre o ProtoTask

O ProtoTask é uma aplicação básica para controle de projetos e suas respectivas atividades.  
O sistema apresenta as seguintes funcionalidades:

- CRUD de Projetos (nome, data de início e data de entrega)
- CRUD de Atividades (nome, projeto, data de início, data de entrega, finalizada)
- Indicação de atraso caso a data de entrega de alguma das atividades exceda a do projeto
- Indicação de atraso caso a data atual seja maior que a de entrega do projeto e ainda haja atividades pendentes
- Percentual de entregas das atividades


## Tecnologias

- Backend: PHP (Laravel) 
- Frontend: HTML, CSS e JQuery
- Banco de Dados: MySQL 

## Pré requisitos

- PHP >= 7.3 
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Composer

## Instruções

Clone este repositório  
```$ git clone <https://github.com/MariaPiontkowski/ProtoTask.git>```

Rode o composer  
```$ composer install```

Rode as migrations  
```$ php artisan migrate```

Caso tenha dificuldade com as migrations, há um DUMP da no diretório  
```database/```
