# Desafio Deliver IT

## Sobre a aplicação

Aplicação de base Docker + PHP-7.4-FPM Alpine + Nginx
para montagem, com os FrameWorks Laravel.

## Para rodar o projeto

Build o docker

Clone o projeto:
```sh
git clone https://github.com/mateusmrj/corrida.git
```
Navege até a pasta do projeto.

Execute:

```sh
docker-compose up -d --build

docker exec -it server-delivery sh
```
ou, se for o caso

```sh
docker exec -it server-delivery bash
```

Projeto está rodando na porta 80 inicialmente.

### As rotas 
Coleção para com as rotas e teste das mesmas,
está no arquivo Corrida.postman_collection.json na base do projeto.

